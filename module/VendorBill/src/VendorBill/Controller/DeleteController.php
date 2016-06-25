<?php
namespace VendorBill\Controller;

use Application\Controller\BaseController;
use VendorBill\Service\BillServiceInterface;
use Vendor\Service\VendorServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
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
     * @param VendorServiceInterface $vendorService            
     * @param BillServiceInterface $billService            
     */
    public function __construct(VendorServiceInterface $vendorService, BillServiceInterface $billService)
    {
        $this->vendorService = $vendorService;
        
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
        
        $vendorEntity = $this->vendorService->get($id);
        
        if (! $vendorEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find vendor');
            
            return $this->redirect()->toRoute('vendor-index');
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Vendors');
        
        $this->layout()->setVariable('pageSubTitle', 'Bill');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-index');
        
        // return view
        return new ViewModel(array());
    }
}