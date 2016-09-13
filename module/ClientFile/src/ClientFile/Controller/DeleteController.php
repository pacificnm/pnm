<?php
namespace ClientFile\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use ClientFile\Service\ClientFileServiceInterface;
use WorkorderFile\Service\WorkorderFileServiceInterface;
use File\Service\FileServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
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
     * @var WorkorderFileServiceInterface
     */
    protected $workorderFileService;

    /**
     *
     * @var FileServiceInterface
     */
    protected $fileService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param ClientFileServiceInterface $clientFileService            
     * @param WorkorderFileServiceInterface $workorderFileService            
     * @param FileServiceInterface $fileService            
     */
    public function __construct(ClientServiceInterface $clientService, ClientFileServiceInterface $clientFileService, WorkorderFileServiceInterface $workorderFileService, FileServiceInterface $fileService)
    {
        $this->clientService = $clientService;
        
        $this->clientFileService = $clientFileService;
        
        $this->workorderFileService = $workorderFileService;
        
        $this->fileService = $fileService;
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
        
        $request = $this->getRequest();
        
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
        
        $fileEntity = $this->fileService->get($clientFileEntity->getFileId());
        
        // we have post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                // delete workorder file
                $this->workorderFileService->deleteWorkorderFile($clientFileEntity->getFileId());
                
                // delete client file
                $this->clientFileService->delete($clientFileEntity);
                
                // delete file
                $this->fileService->delete($fileEntity);
                
                $this->flashMessenger()->addSuccessMessage('The file was deleted');
                
                return $this->redirect()->toRoute('client-file-index', array(
                    'clientId' => $clientId
                ));
            }
            
            return $this->redirect()->toRoute('client-file-view', array(
                'clientId' => $clientId,
                'clientFileId' => $clientFileId
            ));
        }
        
        // set layout vars
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'Delete File');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'client-file-index');
        
        // return view
        return new ViewModel(array(
            'clientFileEntity' => $clientFileEntity,
            'clientEntity' => $clientEntity,
            'clientId' => $clientId
        ));
    }
}
