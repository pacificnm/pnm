<?php
namespace VendorBill\Controller;

use Application\Controller\BaseController;
use VendorBill\Service\BillServiceInterface;
use VendorBill\Form\BillForm;
use Vendor\Service\VendorServiceInterface;
use Zend\View\Model\ViewModel;
use VendorPayment\Form\PaymentForm;
use Account\Service\AccountServiceInterface;
use VendorAccount\Service\AccountServiceInterface as VendorAccountServiceInterface;
use VendorPayment\Service\PaymentServiceInterface;

class CreateController extends BaseController
{

    /**
     *
     * @var VendorServiceInterface
     */
    protected $vendorService;

    /**
     *
     * @var BillServiceInterface
     */
    protected $billService;

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
     * @var PaymentServiceInterface
     */
    protected $paymentService;

    /**
     *
     * @var BillForm
     */
    protected $billForm;

    /**
     *
     * @var PaymentForm
     */
    protected $paymentForm;

    /**
     *
     * @param VendorServiceInterface $vendorService            
     * @param BillServiceInterface $billService            
     * @param AccountServiceInterface $accountService            
     * @param VendorAccountServiceInterface $vendorAccountService            
     * @param PaymentServiceInterface $paymentService            
     * @param BillForm $bilForm            
     * @param PaymentForm $paymentForm            
     */
    public function __construct(VendorServiceInterface $vendorService, BillServiceInterface $billService, AccountServiceInterface $accountService, VendorAccountServiceInterface $vendorAccountService, PaymentServiceInterface $paymentService, BillForm $bilForm, PaymentForm $paymentForm)
    {
        $this->vendorService = $vendorService;
        
        $this->billService = $billService;
        
        $this->accountService = $accountService;
        
        $this->vendorAccountService = $vendorAccountService;
        
        $this->paymentService = $paymentService;
        
        $this->billForm = $bilForm;
        
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
        
        $request = $this->getRequest();
        
        $vendorEntity = $this->vendorService->get($id);
        
        $vendorAccountEntity = $this->vendorAccountService->getVendorAccount($id);
        
        // validate vendor
        if (! $vendorEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find vendor');
            
            return $this->redirect()->toRoute('vendor-index');
        }
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->billForm->setData($postData);
            
            $this->paymentForm->setData($postData);
            
            // if we are valid
            if ($this->billForm->isValid() && $this->paymentForm->isValid()) {
                
                $billEntity = $this->billForm->getData();
                
                $billEntity->setVendorBillDateDue(strtotime($billEntity->getVendorBillDateDue()));
                
                $billEntity->setVendorBillBalance($billEntity->getVendorBillAmount());
                
                $paymentEntity = $this->paymentForm->getData();
                
                // add bill to vendor account service
                $this->accountService->addLedgerCreditItem($vendorAccountEntity->getAccountId(), $vendorAccountEntity->getAccountId(), $billEntity->getVendorBillAmount(), $billEntity->getVendorBillMemo());
                
                // if we chose an account then create the payment
                if ($paymentEntity->getAccountId() > 0) {
                    
                    $paymentEntity->setVendorPaymentDate(strtotime($paymentEntity->getVendorPaymentDate()));
                    
                    // if we paid the full amount
                    if ($paymentEntity->getVendorPaymentAmount() == $billEntity->getVendorBillAmount()) {
                        
                        $billEntity->setVendorBillDatePaid($paymentEntity->getVendorPaymentDate());
                        
                        $billEntity->setVendorBillStatus('Paid');
                        
                        $billEntity->setVendorBillBalance(0);
                        
                        // save bill
                        $billEntity = $this->billService->save($billEntity);
                        
                        // debit pay from account
                        $ledgerEntity = $this->accountService->addLedgerDebitItem($paymentEntity->getAccountId(), $vendorAccountEntity->getAccountId(), $paymentEntity->getVendorPaymentAmount(), $billEntity->getVendorBillMemo());
                        
                        // debit vendor bill
                        $this->accountService->addLedgerDebitItem($vendorAccountEntity->getAccountId(), $paymentEntity->getAccountId(), $paymentEntity->getVendorPaymentAmount(), $billEntity->getVendorBillMemo());
                        
                        // save payment
                        $paymentEntity->setVendorBillId($billEntity->getVendorBillId());
                        
                        $paymentEntity->setAccountLedgerId($ledgerEntity->getAccountLedgerId());
                        
                        $paymentEntity = $this->paymentService->save($paymentEntity);
                        
                        $this->flashMessenger()->addSuccessMessage('The bill and payment was saved');
                        
                        return $this->redirect()->toRoute('vendor-view', array(
                            'vendorId' => $id
                        ));
                    } else {
                        
                        // we have a balance
                        $billEntity->setVendorBillBalance($billEntity->getVendorBillAmount() - $paymentEntity->getVendorPaymentAmount());
                        
                        // save payment
                        if ($paymentEntity->getVendorPaymentAmount() > 0) {
                            
                            $billEntity->setVendorBillBalance($billEntity->getVendorBillAmount() - $paymentEntity->getVendorPaymentAmount());
                            
                            $paymentEntity->setVendorPaymentDate($paymentEntity->getVendorPaymentDate());
                            
                            // if the balance is 0 close out bill
                            if ($billEntity->getVendorBillBalance() == 0) {
                                
                                $billEntity->setVendorBillStatus('Paid');
                                
                                $billEntity->setVendorBillDatePaid($paymentEntity->getVendorPaymentDate());
                            }
                            
                            $this->billService->save($billEntity);
                            
                            // debit pay from account
                            $ledgerEntity = $this->accountService->addLedgerDebitItem($paymentEntity->getAccountId(), $vendorAccountEntity->getAccountId(), $paymentEntity->getVendorPaymentAmount(), $billEntity->getVendorBillMemo());
                            
                            // debit vendor bill
                            $this->accountService->addLedgerDebitItem($vendorAccountEntity->getAccountId(), $paymentEntity->getAccountId(), $paymentEntity->getVendorPaymentAmount(), $billEntity->getVendorBillMemo());
                            
                            // save payment
                            $paymentEntity->setVendorBillId($billEntity->getVendorBillId());
                            
                            $paymentEntity->setAccountLedgerId($ledgerEntity->getAccountLedgerId());
                            
                            $paymentEntity = $this->paymentService->save($paymentEntity);
                            
                            $this->flashMessenger()->addSuccessMessage('The bill and payment was saved with a balance due');
                            
                            return $this->redirect()->toRoute('vendor-bill-view', array(
                                'vendorId' => $id,
                                'vendorBillId' => $billEntity->getVendorBillId()
                            ));
                        } else {
                            
                            // save bill
                            $this->billService->save($billEntity);
                            
                            $this->flashMessenger()->addSuccessMessage('The bill was saved');
                            
                            return $this->redirect()->toRoute('vendor-view', array(
                                'vendorId' => $id
                            ));
                        }
                    }
                } else {
                    // no payment just save bill and return
                    $billEntity = $this->billService->save($billEntity);
                    
                    $this->flashMessenger()->addSuccessMessage('The bill was saved');
                    
                    return $this->redirect()->toRoute('vendor-view', array(
                        'vendorId' => $id
                    ));
                }
            }
        }
        
        // form defaults
        $this->billForm->get('vendorBillId')->setValue(0);
        
        $this->billForm->get('vendorId')->setValue($id);
        
        $this->billForm->get('vendorBillDateCreate')->setValue(time());
        
        $this->billForm->get('vendorBillDatePaid')->setValue(0);
        
        $this->billForm->get('vendorBillBalance')->setValue(0);
        
        $this->billForm->get('vendorBillStatus')->setValue('Un-Paid');
        
        // payment form defaults
        $this->paymentForm->get('vendorPaymentId')->setValue(0);
        
        $this->paymentForm->get('accountLedgerId')->setValue(0);
        
        $this->paymentForm->get('vendorPaymentActive')->setValue(1);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Bill');
        
        $this->layout()->setVariable('pageSubTitle', 'Create');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-index');
        
        // return view
        return new ViewModel(array(
            'form' => $this->billForm,
            'paymentForm' => $this->paymentForm
        ));
    }
}