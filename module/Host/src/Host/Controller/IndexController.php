<?php
namespace Host\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Host\Service\HostServiceInterface;
use HostType\Service\TypeService;

class IndexController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var HostServiceInterface
     */
    protected $hostService;

    /**
     *
     * @var TypeService
     */
    protected $typeService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param HostServiceInterface $hostService            
     * @param TypeService $typeService            
     */
    public function __construct(ClientServiceInterface $clientService, HostServiceInterface $hostService, TypeService $typeService)
    {
        $this->clientService = $clientService;
        
        $this->hostService = $hostService;
        
        $this->typeService = $typeService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $page = $this->params()->fromQuery('page', 1);
        
        $countPerPage = $this->params()->fromQuery('count-per-page', 25);
        
        $hostStatus = $this->params()->fromQuery('host-status', 'Active');
        
        $hostTypeId = $this->params()->fromQuery('host-type', null);
        
        $keyword = $this->params()->fromQuery('keyword', null);
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'View Client ' . $clientEntity->getClientName() . ' hosts');
        
        
        // get host types
        $typeEntites = $this->typeService->getAll(array());
        
        // get hosts
        $filter = array(
            'clientId' => $id,
            'hostStatus' => $hostStatus,
            'hostTypeId' => $hostTypeId,
            'keyword' => $keyword
        );
        
        $paginator = $this->hostService->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // set layout vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Hosts');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        // set head title
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'paginator' => $paginator,
            'page' => $page,
            'hostStatus' => $hostStatus,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(
                'clientId' => $id
            ),
            'typeEntites' => $typeEntites,
            'hostTypeId' => $hostTypeId,
            'keyword' => $keyword
        ));
    }
}
