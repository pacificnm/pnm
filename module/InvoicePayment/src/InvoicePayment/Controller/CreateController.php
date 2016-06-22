<?php
namespace InvoicePayment\Controller;

use Application\Controller\BaseController;
use Invoice\Service\InvoiceServiceInterface;
use InvoicePayment\Service\PaymentServiceInterface;
use InvoicePayment\Form\PaymentForm;
use Client\Service\ClientServiceInterface;
use ClientAccount\Service\AccountServiceInterface;
use AccountLedger\Service\LedgerServiceInterface;

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
     * @var AccountServiceInterface
     */
    protected $clientAccountService;

    /**
     *
     * @var \Account\Service\AccountServiceInterface
     */
    protected $accountService;

    /**
     *
     * @var LedgerServiceInterface
     */
    protected $ledgerService;

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
     * @param AccountServiceInterface $clientAccountService            
     * @param \Account\Service\AccountServiceInterface $accountService            
     * @param LedgerServiceInterface $ledgerService            
     * @param PaymentForm $paymentForm            
     */
    public function __construct(ClientServiceInterface $clientService, InvoiceServiceInterface $invoiceService, PaymentServiceInterface $paymentService, AccountServiceInterface $clientAccountService, \Account\Service\AccountServiceInterface $accountService, LedgerServiceInterface $ledgerService, PaymentForm $paymentForm)
    {
        $this->clientService = $clientService;
        
        $this->invoiceService = $invoiceService;
        
        $this->paymentService = $paymentService;
        
        $this->clientAccountService = $clientAccountService;
        
        $this->accountService = $accountService;
        
        $this->ledgerService = $ledgerService;
        
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
        
        // get client account
        $clientAccountEntity = $this->clientAccountService->getClientAccount($clientEntity->getClientId());
        
        if (! $clientAccountEntity) {
            $this->flashMessenger()->addErrorMessage('Client is missing an account to recieve payments');
            
            return $this->redirect()->toRoute('invoice-view', array(
                'clientId' => $id,
                'invoiceId' => $invoiceId
            ));
        }
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            
            $postData = $request->getPost();
            
            $this->paymentForm->setData($postData);
            
            if ($this->paymentForm->isValid()) {
                
                $entity = $this->paymentForm->getData();
                
                $accountEntity = $this->accountService->get($entity->getAccountId());
                
                if (! $accountEntity) {
                    $this->flashMessenger()->addErrorMessage('cannot find payment account');
                    
                    return $this->redirect()->toRoute('invoice-view', array(
                        'clientId' => $id,
                        'invoiceId' => $invoiceId
                    ));
                }
                                
                $entity->setInvoicePaymentDate(strtotime($entity->getInvoicePaymentDate()));
                
                $payemntEntity = $this->paymentService->save($entity);
                
                // update invoice
                $invoiceEntity->setInvoiceDatePaid(time());
                $invoiceEntity->setInvoicePayment($entity->getInvoicePaymentAmount());
                $invoiceEntity->setInvoiceStatus('Paid');
                $invoiceEntity->setInvoiceBalance($invoiceEntity->getInvoiceBalance() - $entity->getInvoicePaymentAmount());
                
                $this->invoiceService->save($invoiceEntity);
                
                
                // save payment account
                $accountLedgerBalance = $accountEntity->getAccountBalance() + $entity->getInvoicePaymentAmount();
                
                $this->ledgerService->createLedgerEntry($accountEntity->getAccountId(), $clientAccountEntity->getAccountId(), 'Deposit', $entity->getInvoicePaymentAmount(), 0, $accountLedgerBalance, $invoiceId, $payemntEntity->getInvoicePaymentId());
                
                $accountEntity->setAccountBalance($accountLedgerBalance);
                
                $this->accountService->save($accountEntity);
                
                
                
                // save client account
                $accountLedgerBalance = $clientAccountEntity->getAccountEntity()->getAccountBalance() + ($invoiceEntity->getInvoiceTotal() - $entity->getInvoicePaymentAmount());
                
                $this->ledgerService->createLedgerEntry($clientAccountEntity->getAccountId(), $accountEntity->getAccountId(), 'Transfer', 0, $entity->getInvoicePaymentAmount(), $accountLedgerBalance, $invoiceId, $payemntEntity->getInvoicePaymentId());
                
                $clientAccountEntity->getAccountEntity()->setAccountBalance($accountLedgerBalance);
                
                $this->accountService->save($clientAccountEntity->getAccountEntity());
                
                
                
                // set flash
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
