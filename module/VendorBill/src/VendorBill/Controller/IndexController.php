<?php
namespace VendorBill\Controller;

use Application\Controller\BaseController;
use VendorBill\Service\BillServiceInterface;
use Vendor\Service\VendorServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
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
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        $paginator = $this->billService->getUnpaidBills();
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Vendors');
        
        $this->layout()->setVariable('pageSubTitle', 'Bill');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-bill-index');
        
        // return view
        return new ViewModel(array(
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(),
        ));
    }
}