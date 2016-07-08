<?php
namespace InvoicePayment\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Invoice\Service\InvoiceServiceInterface;
use InvoicePayment\Service\PaymentServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
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
     * @param ClientServiceInterface $clientService            
     * @param InvoiceServiceInterface $invoiceService            
     * @param PaymentServiceInterface $paymentService            
     */
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, PaymentServiceInterface $paymentService)
    {
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->paymentService = $paymentService;
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
        
        $paymentId = $this->params()->fromRoute('invoicePaymentId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $invoiceEntity = $this->invoiceService->get($invoiceId);
        
        if (! $invoiceEntity) {
            $this->flashmessenger()->addErrorMessage('Invoice was not found.');
            
            return $this->redirect()->toRoute('invoice-list', array(
                'clientId' => $id
            ));
        }
        
        $paymentEntity = $this->paymentService->get($paymentId);
        
        if (! $paymentEntity) {
            $this->flashmessenger()->addErrorMessage('Invoice Payment was not found.');
            
            return $this->redirect()->toRoute('invoice-view', array(
                'clientId' => $id,
                'invoiceId' => $invoiceId
            ));
        }
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Delete Payment');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'invoice-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
               // clear payemnt from invocie
               $invoiceEntity->setInvoiceDatePaid(0);
               $invoiceEntity->setInvoiceStatus('Un-Paid');
               
               $invoiceEntity->setInvoicePayment($invoiceEntity->getInvoicePayment() - $paymentEntity->getInvoicePaymentAmount());
               $invoiceEntity->setInvoiceBalance($invoiceEntity->getInvoiceBalance() + $paymentEntity->getInvoicePaymentAmount());

               $this->invoiceService->save($invoiceEntity);
               
               $this->paymentService->delete($paymentEntity);
                
               $this->flashmessenger()->addSuccessMessage('The invoice payment was deleted');
            }
            
            return $this->redirect()->toRoute('invoice-view', array(
                'clientId' => $id,
                'invoiceId' => $invoiceId
            ));
        }
        
        return new ViewModel(array(
            'paymentEntity' => $paymentEntity
        ));
    }
}
