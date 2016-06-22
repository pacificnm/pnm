<?php
namespace Vendor\Controller;

use Application\Controller\BaseController;

use Vendor\Service\VendorServiceInterface;
use Zend\View\Model\ViewModel;
use Vendor\Form\VendorForm;

class UpdateController extends BaseController
{
    /**
     *
     * @var VendorServiceInterface
     */
    protected $vendorService;
    
    /**
     * 
     * @var VendorForm
     */
    protected $vendorForm;
    
    /**
     * 
     * @param VendorServiceInterface $vendorService
     * @param VendorForm $vendorForm
     */
    public function __construct(VendorServiceInterface $vendorService, VendorForm $vendorForm)
    {
        $this->vendorService = $vendorService;
        
        $this->vendorForm = $vendorForm;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
    
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Vendors');
    
        $this->layout()->setVariable('pageSubTitle', 'List');
    
        $this->layout()->setVariable('activeMenuItem', 'account');
    
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-index');
    
    
        return new ViewModel();
    }
}
