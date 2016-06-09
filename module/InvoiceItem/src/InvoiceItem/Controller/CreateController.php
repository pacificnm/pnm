<?php
namespace InvoiceItem\Controller;

use Application\Controller\BaseController;
use Invoice\Service\InvoiceServiceInterface;
use InvoiceItem\Service\ItemServiceInterface;
use InvoiceItem\Form\ItemForm;
use Client\Service\ClientServiceInterface;

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
     * @var ItemServiceInterface
     */
    protected $itemService;
    
    /**
     * 
     * @var ItemForm
     */
    protected  $itemForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param InvoiceServiceInterface $invoiceService
     * @param ItemServiceInterface $itemService
     * @param ItemForm $itemForm
     */
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, ItemServiceInterface $itemService, ItemForm $itemForm)
    {
        
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->itemService = $itemService;
        
        $this->itemForm = $itemForm;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $invoiceId = $this->params()->fromRoute('invoiceId');
        
        $request = $this->getRequest();
        
        // get client
        $clientEntity = $this->clientService->get($clientId);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-list');
        }
        
        // get invoice
        $invoiceEntity = $this->invoiceService->get($invoiceId);
        
        if (! $invoiceEntity) {
            $this->flashmessenger()->addErrorMessage('Invoice was not found.');
        
            return $this->redirect()->toRoute('invoice-list', array(
                'clientId' => $clientId
            ));
        }
        
        // if we have a post
        if ($request->isPost()) {
            $postData = $request->getPost();
        
            $this->itemForm->setData($postData);
        
            if ($this->itemForm->isValid()) {
        
                
                $entity = $this->itemForm->getData();
        
                $entity->setInvoiceItemTotal($entity->getInvoiceItemQty() * $entity->getInvoiceItemAmount());
                
                $this->itemService->save($entity);
        
                $invoiceEntity->setInvoiceSubtotal($invoiceEntity->getInvoiceSubtotal() + $entity->getInvoiceItemTotal());
                $invoiceEntity->setInvoiceTotal($invoiceEntity->getInvoiceTotal() + $entity->getInvoiceItemTotal());
                $invoiceEntity->setInvoiceBalance($invoiceEntity->getInvoiceBalance() + $entity->getInvoiceItemTotal());
                
                $this->invoiceService->save($invoiceEntity);
                
                $this->flashmessenger()->addSuccessMessage('The item was added to the invoice.');
        
                return $this->redirect()->toRoute('invoice-view', array(
                    'clientId' => $clientId,
                    'invoiceId' => $invoiceId
                ));
            }
        }
        
        $this->flashmessenger()->addErrorMessage('The item was NOT added to the invoice.');
        
        return $this->redirect()->toRoute('invoice-view', array(
            'clientId' => $clientId,
            'invoiceId' => $invoiceId
        ));
    }
}
