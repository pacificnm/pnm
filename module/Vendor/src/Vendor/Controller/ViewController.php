<?php
namespace Vendor\Controller;

use Application\Controller\BaseController;
use Vendor\Service\VendorServiceInterface;
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
     * @param VendorServiceInterface $vendorService            
     */
    public function __construct(VendorServiceInterface $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    /**
     *
     * {@inheritDoc}
     *
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