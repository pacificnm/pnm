<?php
namespace ClientFile\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use ClientFile\Service\ClientFileServiceInterface;
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
     * @var ClientFileServiceInterface
     */
    protected $clientFileService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param ClientFileServiceInterface $clientFileService            
     */
    public function __construct(ClientServiceInterface $clientService, ClientFileServiceInterface $clientFileService)
    {
        $this->clientService = $clientService;
        
        $this->clientFileService = $clientFileService;
    }

    /**
     *
     * {@inheritDoc}
     *
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
        
        $paginator = $this->clientFileService->getClientFiles($clientId);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // set layout vars
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'Files');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'client-file-index');
        
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
            )
        ));
    }
}