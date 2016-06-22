<?php
namespace Vendor\Controller;

use Application\Controller\BaseController;
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
     * @param VendorServiceInterface $vendorService
     */
    public function __construct(VendorServiceInterface $vendorService)
    {
        $this->vendorService = $vendorService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        // get paginator
        $filter = array();
        
        $paginator = $this->vendorService->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Vendors');
        
        $this->layout()->setVariable('pageSubTitle', 'List');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-index');
        
        
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