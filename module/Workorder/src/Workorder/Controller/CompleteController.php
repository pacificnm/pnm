<?php
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use InvoiceOption\Service\OptionServiceInterface;
use WorkorderTime\Service\TimeServiceInterface;
use WorkorderPart\Service\PartServiceInterface;
use Workorder\Form\CompleteForm;
use Invoice\Entity\InvoiceEntity;
use InvoiceItem\Entity\ItemEntity;

class CompleteController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    /**
     *
     * @var TimeServiceInterface
     */
    protected $timeService;

    /**
     *
     * @var PartServiceInterface
     */
    protected $partService;

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
     * @var OptionServiceInterface
     */
    protected $optionService;

    protected $completeForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param WorkorderServiceInterface $workorderService            
     * @param TimeServiceInterface $timeService            
     * @param PartServiceInterface $partService            
     * @param InvoiceServiceInterface $invoiceService            
     * @param ItemServiceInterface $itemService            
     * @param OptionServiceInterface $optionService            
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, TimeServiceInterface $timeService, PartServiceInterface $partService, InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService, OptionServiceInterface $optionService, CompleteForm $completeForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->timeService = $timeService;
        
        $this->partService = $partService;
        
        $this->invoiceService = $invoiceService;
        
        $this->itemService = $itemService;
        
        $this->optionService = $optionService;
        
        $this->completeForm = $completeForm;
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
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-list');
        }
        
        $workorderEntity = $this->workorderService->get($workorderId);
        
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
            
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $id
            ));
        }
        
        $optionEntity = $this->optionService->get(1);
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->completeForm->setData($postData);
            if ($this->completeForm->isValid()) {
                
                \Zend\Debug\Debug::dump($this->completeForm->getData());
                
                $workorderDateClose = strtotime($postData['workorderDateClose']);
                
                $workorderEntity->setWorkorderDateClose($workorderDateClose);
                
                $workorderEntity->setWorkorderStatus('Closed');
                
                $this->workorderService->save($workorderEntity);
                
                $invoiceBalance = $workorderEntity->getWorkorderLabor() + $workorderEntity->getWorkorderParts();
                
                // calculate invoice Tax
                
                // create invoice
                $invoiceEntity = new InvoiceEntity();
                
                $invoiceEntity->setClientId($id);
                $invoiceEntity->setInvoiceBalance($invoiceBalance);
                $invoiceEntity->setInvoiceDate($workorderDateClose);
                $invoiceEntity->setInvoiceDateEnd($workorderDateClose);
                $invoiceEntity->setInvoiceDatePaid(0);
                $invoiceEntity->setInvoiceDateStart($workorderDateClose);
                $invoiceEntity->setInvoiceDiscount(0);
                $invoiceEntity->setInvoicePayment(0);
                $invoiceEntity->setInvoiceStatus('Un-Paid');
                $invoiceEntity->setInvoiceSubtotal($invoiceBalance);
                $invoiceEntity->setInvoiceTax(0);
                $invoiceEntity->setInvoiceTotal($invoiceBalance);
                
                $invoiceEntity = $this->invoiceService->save($invoiceEntity);
                
                // check for balance forward
                
                // loop through labor add items
                $laborEntitys = $this->timeService->getAll(array(
                    'workorderId' => $workorderId
                ));
                foreach ($laborEntitys as $laborEntity) {
                    $itemEntity = new ItemEntity();
                    
                    $invoiceItemQty = number_format(($laborEntity->getWorkorderTimeTotal() / 60) / 60, 2);
                    
                    $itemEntity->setInvoiceId($invoiceEntity->getInvoiceId());
                    $itemEntity->setInvoiceItemQty($invoiceItemQty);
                    $itemEntity->setInvoiceItemDescrip($laborEntity->getLaborName());
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
                    $itemEntity->setInvoiceItemDescrip($partEntity->getWorkorderPartsDescription());
                    $itemEntity->setInvoiceItemAmount($partEntity->getWorkorderPartsAmount());
                    $itemEntity->setInvoiceItemTotal($partEntity->getWorkorderPartsTotal());
                    $itemEntity->setInvoiceItemDate(time());
                    $itemEntity = $this->itemService->save($itemEntity);
                }
                
                // save history
                
                $this->flashmessenger()->addSuccessMessage('The work order was completed and the invoice was created.');
                
                // redirect to view invoice
                return $this->redirect()->toRoute('invoice-view', array(
                    'clientId' => $id,
                    'invoiceId' => $invoiceEntity->getInvoiceId()
                ));
            }
            
            // redirect back to view workorder
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $id,
                'workorderId' => $workorderId
            ));
        } else {
            // redirect back to view workorder
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $id,
                'workorderId' => $workorderId
            ));
        }
    }
}
