<?php
namespace Client\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     */
    public function __construct(ClientServiceInterface $clientService)
    {
        $this->clientService = $clientService;
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
        
        $filter = array();
        
        $paginator = $this->clientService->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        $this->layout()->setVariable('pageTitle', 'Clients');
        
        // return view model
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