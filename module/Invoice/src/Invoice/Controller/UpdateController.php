<?php
namespace Invoice\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Invoice\Form\InvoiceForm;
use Invoice\Service\InvoiceServiceInterface;

class UpdateController extends BaseController
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
     * @var InvoiceForm
     */
    protected $invoiceForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param InvoiceServiceInterface $invoiceService
     * @param InvoiceForm $invoiceForm
     */
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, InvoiceForm $invoiceForm)
    {
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->invoiceForm = $invoiceForm;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
    
        $invoiceId = $this->params()->fromRoute('invoiceId');
        
        $clientEntity = $this->clientService->get($id);
    
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
    
        // get invoice
        $invoiceEntity = $this->invoiceService->get($invoiceId);
        
        if (! $invoiceEntity) {
            $this->flashmessenger()->addErrorMessage('Invoice was not found.');
        
            return $this->redirect()->toRoute('invoice-list', array(
                'clientId' => $id
            ));
        }
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            $postData = $request->getPost();
        
            $this->invoiceForm->setData($postData);
        
            if ($this->invoiceForm->isValid()) {
        
                $entity = $this->invoiceForm->getData();
                
                $entity->setInvoiceDate(strtotime($entity->getInvoiceDate()));
                $entity->SetInvoiceDateStart(strtotime($entity->getInvoiceDateStart()));
                $entity->setInvoiceDateEnd(strtotime($entity->getInvoiceDateEnd()));
                
                if($entity->getInvoiceDatePaid() > 0) {
                    $entity->setInvoiceDatePaid(strtotime($entity->getInvoiceDatePaid()));
                }
                
                $this->invoiceService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The invoice was saved.');
                
                return $this->redirect()->toRoute('invoice-view', array(
                    'clientId' => $id,
                    'invoiceId' => $invoiceId
                ));
            }
        }
        
        
        $this->invoiceForm->bind($invoiceEntity);
        
        $this->invoiceForm->get('invoiceDate')->setValue(date("m/d/Y", $invoiceEntity->getInvoiceDate()));
        $this->invoiceForm->get('invoiceDateStart')->setValue(date("m/d/Y", $invoiceEntity->getInvoiceDateStart()));
        $this->invoiceForm->get('invoiceDateEnd')->setValue(date("m/d/Y", $invoiceEntity->getInvoiceDateEnd()));
        $this->invoiceForm->get('invoiceDatePaid')->setValue(date("m/d/Y", $invoiceEntity->getInvoiceDatePaid()));
        
        $this->layout()->setVariable('clientId', $id);
    
        $this->layout()->setVariable('pageTitle', 'Edit Invoice');
    
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
    
        $this->setHeadTitle($clientEntity->getClientName());
    
        $this->layout()->setVariable('activeMenuItem', 'client');
    
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $this->invoiceForm
        ));
    }
}