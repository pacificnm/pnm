<?php
namespace Vendor\Controller;

use Application\Controller\BaseController;
use Vendor\Service\VendorServiceInterface;
use Zend\View\Model\ViewModel;
use VendorAccount\Service\AccountServiceInterface;
use VendorBill\Service\BillServiceInterface;

class ViewController extends BaseController
{

    /**
     *
     * @var VendorServiceInterface
     */
    protected $vendorService;

    /**
     * 
     * @var AccountServiceInterface
     */
    protected $accountService;
    
    /**
     * 
     * @var BillServiceInterface
     */
    protected $billService;
    
    /**
     * 
     * @param VendorServiceInterface $vendorService
     * @param AccountServiceInterface $accountService
     * @param BillServiceInterface $billService
     */
    public function __construct(VendorServiceInterface $vendorService, AccountServiceInterface $accountService, BillServiceInterface $billService)
    {
        $this->vendorService = $vendorService;
        
        $this->accountService = $accountService;
        
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
        
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        $vendorEntity = $this->vendorService->get($id);
        
        if(! $vendorEntity) {
            $this->flashMessenger()->addErrorMessage('Could not find vendor');
            
            return $this->redirect()->toRoute('vendor-index');
        }
        
        // get account
        $accountEntity = $this->accountService->getVendorAccount($id);
        
        // get bills
        $filter = array('vendorId' => $id);
        
        $paginator = $this->billService->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Vendors');
        
        $this->layout()->setVariable('pageSubTitle', 'List');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'vendor-index');
        
        return new ViewModel(array(
            'vendorEntity' => $vendorEntity,
            'accountEntity' => $accountEntity,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(),
        ));
    }
}