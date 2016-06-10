<?php
namespace InvoicePayment\Controller;

use Application\Controller\BaseController;
use Invoice\Service\InvoiceServiceInterface;
use InvoicePayment\Service\PaymentServiceInterface;
use InvoicePayment\Form\PaymentForm;
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
     * @var PaymentServiceInterface
     */
    protected $paymentService;

    /**
     *
     * @var PaymentForm
     */
    protected $paymentForm;

    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param InvoiceServiceInterface $invoiceService
     * @param PaymentServiceInterface $paymentService
     * @param PaymentForm $paymentForm
     */
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, PaymentServiceInterface $paymentService, PaymentForm $paymentForm)
    {
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->paymentService = $paymentService;
        
        $this->paymentForm = $paymentForm;
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
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-list');
        }
        
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
        
            $this->paymentForm->setData($postData);
        
            if ($this->paymentForm->isValid()) {
                
                $entity = $this->paymentForm->getData();
                
                $entity->setInvoicePaymentDate(strtotime($entity->getInvoicePaymentDate()));
                
                $this->paymentService->save($entity);
                
                // update invoice
                $invoiceEntity->setInvoiceDatePaid(time());
                $invoiceEntity->setInvoicePayment($entity->getInvoicePaymentAmount());
                $invoiceEntity->setInvoiceStatus('Paid');
                $invoiceEntity->setInvoiceBalance($invoiceEntity->getInvoiceBalance() - $entity->getInvoicePaymentAmount());
                
                $this->invoiceService->save($invoiceEntity);
                
                $this->flashmessenger()->addSuccessMessage('The payment was saved.');
                
                return $this->redirect()->toRoute('invoice-view', array(
                    'clientId' => $id,
                    'invoiceId' => $invoiceId
                ));
            }
        }
        
        $this->flashmessenger()->addErrorMessage('The payment was NOT saved.');
        
        return $this->redirect()->toRoute('invoice-view', array(
            'clientId' => $id,
            'invoiceId' => $invoiceId
        ));
    }
}
