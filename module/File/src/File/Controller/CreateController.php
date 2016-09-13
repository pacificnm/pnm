<?php
namespace File\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use File\Service\FileServiceInterface;
use File\Form\FileForm;

class CreateController extends BaseController
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
     * @var FileForm
     */
    protected $fileForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param FileServiceInterface $fileService
     * @param FileForm $fileForm
     */
    public function __construct(ClientServiceInterface $clientService, FileServiceInterface $fileService, FileForm $fileForm)
    {
        $this->clientService = $clientService;
        
        $this->fileService = $fileService;
        
        $this->fileForm = $fileForm;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $clientEntity = $this->clientService->get($clientId);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        // set layout vars
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'Create File');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'file-index');
    }
}