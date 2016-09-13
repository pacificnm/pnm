<?php
namespace File\Controller;

use Application\Controller\BaseController;
use File\Service\FileServiceInterface;
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
     * @var FileServiceInterface
     */
    protected $fileService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param FileServiceInterface $fileService
     */
    public function __construct(ClientServiceInterface $clientService, FileServiceInterface $fileService)
    {
        $this->clientService = $clientService;
        
        $this->fileService = $fileService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $page = $this->params()->fromQuery('page', 1);
        
        $countPerPage = $this->params()->fromQuery('count-per-page', 25);
        
        $clientEntity = $this->clientService->get($clientId);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        $filter = array(
            'clientId' => $clientId
        );
        
        $paginator = $this->fileService->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // set layout vars
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'Files');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'file-index');
        
        // return view model
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $clientId,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(
                'clientId' => $clientId
            ),
        ));
    }
    
}