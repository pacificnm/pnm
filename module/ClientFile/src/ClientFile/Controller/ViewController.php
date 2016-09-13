<?php
namespace ClientFile\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use ClientFile\Service\ClientFileService;
use Zend\View\Model\ViewModel;


class ViewController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var ClientFileService
     */
    protected $clientFileService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param ClientFileService $clientFileService            
     */
    public function __construct(ClientServiceInterface $clientService, ClientFileService $clientFileService)
    {
        $this->clientFileService = $clientFileService;
        
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
        $clientId = $this->params()->fromRoute('clientId');
        
        $clientFileId = $this->params()->fromRoute('clientFileId');
        
        $clientEntity = $this->clientService->get($clientId);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $clientFileEntity = $this->clientFileService->get($clientFileId);
        
        if (! $clientFileEntity) {
            $this->flashmessenger()->addErrorMessage('Client File was not found.');
            
            return $this->redirect()->toRoute('client-file-index', array(
                'clientId' => $clientId
            ));
        }
        
        // set layout vars
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'View File');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'client-file-index');
        
        return new ViewModel(array(
            'clientFileEntity' => $clientFileEntity,
            'clientId' => $clientId,
            'clientEntity' => $clientEntity
        ));
    }
}
