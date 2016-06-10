<?php
namespace Invoice\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderPart\Service\PartServiceInterface;
use WorkorderTime\Service\TimeServiceInterface;
use Invoice\Form\WorkorderForm;
use Zend\View\Model\ViewModel;
use InvoiceItem\Entity\ItemEntity;

class WorkorderController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var InvoiceServiceInterface
     */
    protected $invoiceService;

    /**
     *
     * @var ItemServiceInterface
     */
    protected $itemService;

    /**
     *
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    /**
     *
     * @var PartServiceInterface
     */
    protected $partService;

    /**
     *
     * @var TimeServiceInterface
     */
    protected $timeService;

    /**
     *
     * @var WorkorderForm
     */
    protected $workorderForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param InvoiceServiceInterface $invoiceService            
     * @param ItemServiceInterface $itemService            
     * @param WorkorderServiceInterface $workorderService            
     * @param PartServiceInterface $partService            
     * @param TimeServiceInterface $timeService            
     * @param WorkorderForm $workorderForm            
     */
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService, WorkorderServiceInterface $workorderService, PartServiceInterface $partService, TimeServiceInterface $timeService, WorkorderForm $workorderForm)
    {
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->workorderService = $workorderService;
        
        $this->itemService = $itemService;
        
        $this->partService = $partService;
        
        $this->timeService = $timeService;
        
        $this->workorderForm = $workorderForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $invoiceId = $this->params()->fromRoute('invoiceId');
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-list');
        }
        
        // get invoice
        $invoiceEntity = $this->invoiceService->get($invoiceId);
        
        if (! $invoiceEntity) {
            $this->flashmessenger()->addErrorMessage('Invoice was not found.');
            
            return $this->redirect()->toRoute('invoice-list', array(
                'clientId' => $id
            ));
        }
        
        $this->workorderForm->setClientId($id)->getWorkorderSelect();
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->workorderForm->setData($postData);
            if ($this->workorderForm->isValid()) {
                
                $workorderId = $postData->workorderId;
                
                $workorderEntity = $this->workorderService->get($workorderId);
                
                if (! $workorderEntity) {
                    $this->flashmessenger()->addErrorMessage('Work Order was not found.');
                    
                    return $this->redirect()->toRoute('invoice-view', array(
                        'clientId' => $id,
                        'invoiceId' => $invoiceId
                    ));
                }
                
                // get charges from work order
                $invoiceBalance = $workorderEntity->getWorkorderLabor() + $workorderEntity->getWorkorderParts();
                
                // update invoice
                $invoiceEntity->setInvoiceSubtotal($invoiceEntity->getInvoiceSubtotal() + $invoiceBalance);
                $invoiceEntity->setInvoiceTotal($invoiceEntity->getInvoiceTotal() + $invoiceBalance);
                $invoiceEntity->setInvoiceBalance($invoiceEntity->getInvoiceBalance() + $invoiceBalance);
                
                $invoiceEntity = $this->invoiceService->save($invoiceEntity);
                
                // loop through labor add items
                $laborEntitys = $this->timeService->getAll(array(
                    'workorderId' => $workorderId
                ));
                foreach ($laborEntitys as $laborEntity) {
                    $itemEntity = new ItemEntity();
                    
                    $invoiceItemQty = number_format(($laborEntity->getWorkorderTimeTotal() / 60) / 60, 2);
                    
                    $itemEntity->setInvoiceId($invoiceEntity->getInvoiceId());
                    $itemEntity->setInvoiceItemQty($invoiceItemQty);
                    $itemEntity->setInvoiceItemDescrip($laborEntity->getLaborName() . ' Work Order #' . $workorderId);
                    $itemEntity->setInvoiceItemAmount($laborEntity->getLaborRate());
                    $itemEntity->setInvoiceItemTotal($laborEntity->getLaborTotal());
                    $itemEntity->setInvoiceItemDate(time());
                    
                    $itemEntity = $this->itemService->save($itemEntity);
                }
                
                // loop through parts
                $partEntitys = $this->partService->getAll(array(
                    'workorderId' => $workorderId
                ));
                foreach ($partEntitys as $partEntity) {
                    $itemEntity = new ItemEntity();
                    
                    $itemEntity->setInvoiceId($invoiceEntity->getInvoiceId());
                    $itemEntity->setInvoiceItemQty($partEntity->getWorkorderPartsQty());
                    $itemEntity->setInvoiceItemDescrip($partEntity->getWorkorderPartsDescription() . ' Work Order #' . $workorderId);
                    $itemEntity->setInvoiceItemAmount($partEntity->getWorkorderPartsAmount());
                    $itemEntity->setInvoiceItemTotal($partEntity->getWorkorderPartsTotal());
                    $itemEntity->setInvoiceItemDate(time());
                    $itemEntity = $this->itemService->save($itemEntity);
                }
                
                // set invoice id
                $workorderEntity->setInvoiceId($invoiceId);
                
                $this->workorderService->save($workorderEntity);
                
                $this->flashmessenger()->addSuccessMessage('The work order was added to the invoice.');
                
                // redirect to view invoice
                return $this->redirect()->toRoute('invoice-view', array(
                    'clientId' => $id,
                    'invoiceId' => $invoiceEntity->getInvoiceId()
                ));
            }
        }
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Add Work Order To Invoice');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'invoice-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        return new ViewModel(array(
            'form' => $this->workorderForm
        ));
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $invoiceId = $this->params()->fromRoute('invoiceId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-list');
        }
        
        // get invoice
        $invoiceEntity = $this->invoiceService->get($invoiceId);
        
        if (! $invoiceEntity) {
            $this->flashmessenger()->addErrorMessage('Invoice was not found.');
            
            return $this->redirect()->toRoute('invoice-list', array(
                'clientId' => $id
            ));
        }
        
        $workorderEntity = $this->workorderService->get($workorderId);
        
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
            
            return $this->redirect()->toRoute('invoice-view', array(
                'clientId' => $id,
                'invoiceId' => $invoiceId
            ));
        }
        
        $workorderEntity->setInvoiceId(0);
        
        $this->workorderService->save($workorderEntity);
        
        $this->flashmessenger()->addSuccessMessage('The work order was removed from the invoice.');
        
        // redirect to view invoice
        return $this->redirect()->toRoute('invoice-view', array(
            'clientId' => $id,
            'invoiceId' => $invoiceId
        ));
    }
}