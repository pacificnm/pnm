<?php
namespace VendorPayment\Controller;

use Application\Controller\BaseController;
use Vendor\Service\VendorServiceInterface;
use VendorPayment\Service\PaymentService;
use VendorBill\Service\BillServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
{

    /**
     *
     * @var VendorServiceInterface
     */
    protected $vendorService;

    /**
     *
     * @var PaymentService
     */
    protected $paymentService;

    /**
     *
     * @var BillServiceInterface
     */
    protected $billService;

    /**
     *
     * @param VendorServiceInterface $vendorService            
     * @param PaymentService $paymentService            
     * @param BillServiceInterface $billService            
     */
    public function __construct(VendorServiceInterface $vendorService, PaymentService $paymentService, BillServiceInterface $billService)
    {
        $this->vendorService = $vendorService;
        
        $this->paymentService = $paymentService;
        
        $this->billService = $billService;
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
        
        $vendorPaymentId = $this->params()->fromRoute('vendorPaymentId');
        
        $vendorEntity = $this->vendorService->get($id);
        
        $billEntity = $this->billService->get($vendorBillId);
        
        $paymentEntity = $this->paymentService->get($vendorPaymentId);
        
        // validate vendor
        if (! $vendorEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find vendor');
            
            return $this->redirect()->toRoute('vendor-index');
        }
        
        // validate bill
        if (! $billEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find bill');
            
            return $this->redirect()->toRoute('vendor-view', array(
                'vendorId' => $id
            ));
        }
        
        // validate payment
        if (! $paymentEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find payment');
            
            return $this->redirect()->toRoute('vendor-bill-view', array(
                'vendorId' => $id,
                'vendorBillId' => $vendorBillId
            ));
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Payment');
        
        $this->layout()->setVariable('pageSubTitle', 'View');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-bill-index');
        
        // return view
        return new ViewModel(array(
            'vendorEntity' => $vendorEntity,
            'billEntity' => $billEntity,
            'paymentEntity' => $paymentEntity
        ));
    }
}
