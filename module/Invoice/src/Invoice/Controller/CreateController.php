<?php
namespace Invoice\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Invoice\Form\InvoiceForm;
use Invoice\Service\InvoiceServiceInterface;

class CreateController extends BaseController
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
    
        $clientEntity = $this->clientService->get($id);
    
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-list');
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
        
                $entity = $this->invoiceService->save($entity);
        
                $this->flashmessenger()->addSuccessMessage('The invoice was saved.');
        
                return $this->redirect()->toRoute('invoice-view', array(
                    'clientId' => $id,
                    'invoiceId' => $entity->getInvoiceId()
                ));
            }
        }
        
        
        $this->invoiceForm->get('invoiceId')->setValue(0);
        
        $this->invoiceForm->get('clientId')->setValue($id);
        
        $this->invoiceForm->get('invoiceStatus')->setValue('Un-Paid');
        
        $this->invoiceForm->get('invoiceDate')->setValue(date("m/d/Y"));
        
        $this->invoiceForm->get('invoiceDateStart')->setValue(date("m/d/Y"));
        
        $this->invoiceForm->get('invoiceDateEnd')->setValue(date("m/d/Y"));
        
        $this->invoiceForm->get('invoiceSubtotal')->setValue(0.00);
        
        $this->invoiceForm->get('invoiceTax')->setValue(0.00);
        
        $this->invoiceForm->get('invoiceDiscount')->setValue(0.00);
        
        $this->invoiceForm->get('invoiceTotal')->setValue(0.00);
        
        $this->invoiceForm->get('invoicePayment')->setValue(0.00);
        
        $this->invoiceForm->get('invoiceBalance')->setValue(0.00);
        
        $this->layout()->setVariable('clientId', $id);
    
        $this->layout()->setVariable('pageTitle', 'Create Invoice');
    
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());

        $this->layout()->setVariable('activeMenuItem', 'client');
    
        $this->layout()->setVariable('activeSubMenuItem', 'invoice-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $this->invoiceForm
        ));
    }
}