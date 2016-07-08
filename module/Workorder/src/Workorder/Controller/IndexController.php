<?php
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;

class IndexController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param WorkorderServiceInterface $workorderService            
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
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
        
        $workorderStatus = $this->params()->fromQuery('workorderStatus', 'Active');
        
        $keyword = $this->params()->fromQuery('keyword', null);
        
        // load client
        $clientEntity = $this->clientService->get($id);
        
        // validate we got client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'View Client ' . $clientEntity->getClientName() . ' work orders');
        
        // set layout vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Work Orders');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        // set head title
        $this->setHeadTitle($clientEntity->getClientName());
        
        $filter = array(
            'clientId' => $id,
            'workorderStatus' => $workorderStatus,
            'keyword' => $keyword
        );
        
        $paginator = $this->workorderService->getAll($filter);
        
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
            ),
            'workorderStatus' => $workorderStatus,
            'keyword' => $keyword
        ));
    }
}
