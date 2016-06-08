<?php
namespace Network\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Network\Service\NetworkServiceInterface;

class IndexController extends BaseController
{   
    /**
     * 
     * @var unknown
     */
    protected $clientService;
    
    /**
     * 
     * @var NetworkServiceInterface
     */
    protected $networkService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param NetworkServiceInterface $networkService
     */
    public function __construct(ClientServiceInterface $clientService, NetworkServiceInterface $networkService)
    {
        $this->clientService = $clientService;
        
        $this->networkService = $networkService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $page = $this->params()->fromQuery('page', 1);
        
        $countPerPage = $this->params()->fromQuery('count-per-page', 25);
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-list');
        }
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'View Client ' . $clientEntity->getClientName() . ' network settings');
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Network Settings');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        $filter = array('clientId' => $id);
        
        $paginator = $this->networkService->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(
                'clientId' => $id
            )
        ));
    }
}