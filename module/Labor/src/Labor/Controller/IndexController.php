<?php
namespace Labor\Controller;

use Application\Controller\BaseController;
use Labor\Service\LaborServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * 
     * @var LaborServiceInterface
     */
    protected $laborService;
    
    /**
     * 
     * @param LaborServiceInterface $laborService
     */
    public function __construct(LaborServiceInterface $laborService)
    {
        $this->laborService = $laborService;
    }
    
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Labor');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        $filter = array();
        
        $paginator = $this->laborService->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        return new ViewModel(array(
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array()
        ));
    }
    
}