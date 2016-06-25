<?php
namespace VendorBill\Controller;

use Application\Controller\BaseController;
use VendorBill\Service\BillServiceInterface;
use Vendor\Service\VendorServiceInterface;
use Zend\View\Model\ViewModel;
use VendorPayment\Service\PaymentServiceInterface;

class ViewController extends BaseController
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
     * @var PaymentServiceInterface
     */
    protected $paymentService;
    
    /**
     * 
     * @param VendorServiceInterface $vendorService
     * @param BillServiceInterface $billService
     * @param PaymentServiceInterface $paymentService
     */
    public function __construct(VendorServiceInterface $vendorService, BillServiceInterface $billService, PaymentServiceInterface $paymentService)
    {
        $this->vendorService = $vendorService;
        
        $this->billService = $billService;
        
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
        $id = $this->params()->fromRoute('vendorId');
        
        $vendorBillId = $this->params()->fromRoute('vendorBillId');
        
        $vendorEntity = $this->vendorService->get($id);
        
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        if (! $vendorEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find vendor');
            
            return $this->redirect()->toRoute('vendor-index');
        }
        
        $billEntity = $this->billService->get($vendorBillId);
        
        if (! $billEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find vendor bill');
            
            return $this->redirect()->toRoute('vendor-view', array(
                'vendorId' => $id
            ));
        }
        
        // payments
        $paginator = $this->paymentService->getVendorBillPayments($vendorBillId);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Vendor Bill');
        
        $this->layout()->setVariable('pageSubTitle', 'View');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-index');
        
        // return view
        return new ViewModel(array(
            'vendorEntity' => $vendorEntity,
            'billEntity' => $billEntity,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(),
            
        ));
    }
}
