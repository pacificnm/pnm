<?php
namespace Auth\Controller;

use Application\Controller\BaseController;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;
use History\Service\HistoryServiceInterface;

class ViewController extends BaseController
{

    /**
     *
     * @var AuthServiceInterface
     */
    protected $authService;

    /**
     *
     * @var HistoryServiceInterface
     */
    protected $historyService;

    /**
     *
     * @param AuthServiceInterface $authService            
     * @param HistoryServiceInterface $historyService            
     */
    public function __construct(AuthServiceInterface $authService, HistoryServiceInterface $historyService)
    {
        $this->authService = $authService;
        
        $this->historyService = $historyService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // auth id
        $id = $this->params()->fromRoute('authId');
        
        // page
        $page = $this->params()->fromQuery('page', 1);
        
        // count per page
        $countPerPage = $this->params()->fromQuery('count-per-page', 24);
        
        // get auth entity
        $authEntity = $this->authService->get($id);
        
        // validate we got an auth
        if (! $authEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the auth ' . $id);
            
            return $this->redirect()->toRoute('auth-index');
        }
        
        // get history
        $filter = array(
            'authId' => $id,
            'order' => 'history_id DESC'
        );
        
        $paginator = $this->historyService->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // set page layout
        $this->layout()->setVariable('pageTitle', 'Auth');
        
        $this->layout()->setVariable('pageSubTitle', 'View');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'auth-index');
        
        // return view model
        return new ViewModel(array(
            'authEntity' => $authEntity,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array('authId' => $id)
        ));
    }
}