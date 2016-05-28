<?php
namespace Auth\Controller;

use Application\Controller\BaseController;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * 
     * @var AuthServiceInterface
     */
    protected $authService;
    
    /**
     * 
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Auth');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        $filter = array();
        
        $paginator = $this->authService->getAll($filter);
        
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