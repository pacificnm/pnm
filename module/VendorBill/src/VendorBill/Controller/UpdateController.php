<?php
namespace VendorBill\Controller;

use Application\Controller\BaseController;
use VendorBill\Service\BillServiceInterface;
use VendorBill\Form\BillForm;
use Vendor\Service\VendorServiceInterface;
use Zend\View\Model\ViewModel;

class UpdateController extends BaseController
{
    /**
     *
     * @var VendorServiceInterface
     */
    protected $vendorService;
    
    /**
     *
     * @var  $vendorService
     * @param BillServiceInterface
     */
    protected $billService;
    
    /**
     *
     * @var BillForm
     */
    protected $billForm;
    
    /**
     *
     * @param VendorServiceInterface $vendorService
     * @param BillServiceInterface $billService
     * @param BillForm $bilForm
     */
    public function __construct(VendorServiceInterface $vendorService, BillServiceInterface $billService, BillForm $bilForm)
    {
        $this->vendorService = $vendorService;
    
        $this->billService = $billService;
    
        $this->billForm = $bilForm;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('vendorId');
    
        $vendorEntity = $this->vendorService->get($id);
    
        if(! $vendorEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find vendor');
    
            return $this->redirect()->toRoute('vendor-index');
        }
    
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Vendors');
        
        $this->layout()->setVariable('pageSubTitle', 'Bill');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-index');
        
        // return view
        return new ViewModel(array(
            'form' => $this->billForm
        ));
    }
}
