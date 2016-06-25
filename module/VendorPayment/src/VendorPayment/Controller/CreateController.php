<?php
namespace VendorPayment\Controller;

use Application\Controller\BaseController;
use Vendor\Service\VendorServiceInterface;
use VendorPayment\Service\PaymentServiceInterface;
use Account\Service\AccountServiceInterface;
use VendorAccount\Service\AccountServiceInterface as VendorAccountServiceInterface;
use VendorPayment\Form\PaymentForm;
use Zend\View\Model\ViewModel;
use VendorBill\Service\BillServiceInterface;

class CreateController extends BaseController
{

    /**
     *
     * @var VendorServiceInterface
     */
    protected $vendorService;

    /**
     *
     * @var PaymentServiceInterface
     */
    protected $paymentService;

    /**
     *
     * @var AccountServiceInterface
     */
    protected $accountService;

    /**
     *
     * @var VendorAccountServiceInterface
     */
    protected $vendorAccountService;

    /**
     *
     * @var BillServiceInterface
     */
    protected $billService;

    /**
     *
     * @var PaymentForm
     */
    protected $paymentForm;

    /**
     *
     * @param VendorServiceInterface $vendorService            
     * @param PaymentServiceInterface $paymentService            
     * @param AccountServiceInterface $accountService            
     * @param unknown $vendorAccountService            
     * @param BillServiceInterface $billService            
     * @param PaymentForm $paymentForm            
     */
    public function __construct(VendorServiceInterface $vendorService, PaymentServiceInterface $paymentService, AccountServiceInterface $accountService, $vendorAccountService, BillServiceInterface $billService, PaymentForm $paymentForm)
    {
        $this->vendorService = $vendorService;
        
        $this->paymentService = $paymentService;
        
        $this->accountService = $accountService;
        
        $this->vendorAccountService = $vendorAccountService;
        
        $this->billService = $billService;
        
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
        $id = $this->params()->fromRoute('vendorId');
        
        $vendorBillId = $this->params()->fromRoute('vendorBillId');
        
        $request = $this->getRequest();
        
        $vendorEntity = $this->vendorService->get($id);
        
        $vendorAccountEntity = $this->vendorAccountService->getVendorAccount($id);
        
        $request = $this->getRequest();
        
        // validate vendor
        if (! $vendorEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find vendor');
            
            return $this->redirect()->toRoute('vendor-index');
        }
        
        $billEntity = $this->billService->get($vendorBillId);
        
        if (! $billEntity) {
            $this->flashMessenger()->addErrorMessage('Could not find bill');
            
            return $this->redirect()->toRoute('vendor-view', array(
                'vendorId' => $id
            ));
        }
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->paymentForm->setData($postData);
            
            // if we are valid
            if ($this->paymentForm->isValid()) {
                
                $entity = $this->paymentForm->getData();
                
                // if we chose an account then create the payment
                if ($entity->getAccountId() > 0) {
                    // if we paid the full amount
                    if ($entity->getVendorPaymentAmount() == $billEntity->getVendorBillAmount()) {
                        
                        $billEntity->setVendorBillDatePaid(strtotime($entity->getVendorPaymentDate()));
                        
                        $billEntity->setVendorBillStatus('Paid');
                        
                        $billEntity->setVendorBillBalance(0);
                        
                        // save bill
                        $billEntity = $this->billService->save($billEntity);
                        
                        // debit pay from account
                        $ledgerEntity = $this->accountService->addLedgerDebitItem($entity->getAccountId(), $vendorAccountEntity->getAccountId(), $entity->getVendorPaymentAmount(), $billEntity->getVendorBillMemo());
                        
                        // debit vendor bill
                        $this->accountService->addLedgerDebitItem($vendorAccountEntity->getAccountId(), $entity->getAccountId(), $entity->getVendorPaymentAmount(), $billEntity->getVendorBillMemo());
                        
                        // save payment
                        $entity->setVendorPaymentDate(strtotime($entity->getVendorPaymentDate()));
                        
                        $entity->setVendorBillId($billEntity->getVendorBillId());
                        
                        $entity->setAccountLedgerId($ledgerEntity->getAccountLedgerId());
                        
                        $paymentEntity = $this->paymentService->save($entity);
                        
                        $this->flashMessenger()->addSuccessMessage('The bill and payment was saved');
                        
                        return $this->redirect()->toRoute('vendor-bill-view', array(
                            'vendorId' => $id,
                            'vendorBillId' => $vendorBillId
                        ));
                    } else {
                        // we have a balance
                        if ($entity->getVendorPaymentAmount() > 0) {
                            
                            $billEntity->setVendorBillBalance($billEntity->getVendorBillBalance() - $entity->getVendorPaymentAmount());
                            
                            $entity->setVendorPaymentDate(strtotime($entity->getVendorPaymentDate()));
                            
                            // if the balance is 0 close out bill
                            if($billEntity->getVendorBillBalance() == 0) {
                                $billEntity->setVendorBillStatus('Paid');
                                
                                $billEntity->setVendorBillDatePaid($entity->getVendorPaymentDate());
                            }
                        
                            
                            $this->billService->save($billEntity);
                            
                            // debit pay from account
                            $ledgerEntity = $this->accountService->addLedgerDebitItem($entity->getAccountId(), $vendorAccountEntity->getAccountId(), $entity->getVendorPaymentAmount(), $billEntity->getVendorBillMemo());
                            
                            // debit vendor bill
                            $this->accountService->addLedgerDebitItem($vendorAccountEntity->getAccountId(), $entity->getAccountId(), $entity->getVendorPaymentAmount(), $billEntity->getVendorBillMemo());
                            
                            // save payment
                            $entity->setVendorBillId($billEntity->getVendorBillId());
                            
                            $entity->setAccountLedgerId($ledgerEntity->getAccountLedgerId());
                            
                            $paymentEntity = $this->paymentService->save($entity);
                            
                            $this->flashMessenger()->addSuccessMessage('The bill and payment was saved with a balance due');
                            
                            return $this->redirect()->toRoute('vendor-bill-view', array(
                                'vendorId' => $id,
                                'vendorBillId' => $vendorBillId
                            ));
                        } else {
                            $this->flashMessenger()->addSuccessMessage('The bill was saved');
                            
                            return $this->redirect()->toRoute('vendor-bill-view', array(
                                'vendorId' => $id,
                                'vendorBillId' => $vendorBillId
                            ));
                        }
                    }
                } else {
                    $this->flashMessenger()->addSuccessMessage('The bill was saved');
                    
                    return $this->redirect()->toRoute('vendor-bill-view', array(
                        'vendorId' => $id,
                        'vendorBillId' => $vendorBillId
                    ));
                }
            }
        }
        
        // set form defaults
        $this->paymentForm->get('vendorPaymentId')->setValue(0);
        
        $this->paymentForm->get('vendorId')->setValue($id);
        
        $this->paymentForm->get('vendorBillId')->setValue($vendorBillId);
        
        $this->paymentForm->get('vendorPaymentActive')->setValue(1);
        
        $this->paymentForm->get('accountLedgerId')->setValue(0);
        
        $this->paymentForm->get('vendorPaymentAmount')->setValue($billEntity->getVendorBillBalance());
        
        $this->paymentForm->get('vendorPaymentDate')->setValue(date("m/d/Y", time()));
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Bill');
        
        $this->layout()->setVariable('pageSubTitle', 'Payment');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-index');
        
        return new ViewModel(array(
            'form' => $this->paymentForm,
            'billEntity' => $billEntity,
            'vendorEntity' => $vendorEntity
        ));
    }
}