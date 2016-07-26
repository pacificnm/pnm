<?php
namespace WorkorderFile\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderFile\Service\WorkorderFileServiceInterface;
use Zend\View\Model\ViewModel;
use File\Service\FileServiceInterface;

class DeleteController extends BaseController
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
     * @param WorkorderServiceInterface $workorderService
     * @param WorkorderFileServiceInterface $workorderFileService
     * @param FileServiceInterface $fileService
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, WorkorderFileServiceInterface $workorderFileService, FileServiceInterface $fileService)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->workorderFileService = $workorderFileService;
        
        $this->fileService = $fileService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $workorderFileId = $this->params()->fromRoute('workorderFileId');
        
        $request = $this->getRequest();
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        $workorderEntity = $this->workorderService->get($workorderId);
        
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
        
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $id
            ));
        }
        
        $workorderFileEntity = $this->workorderFileService->get($workorderFileId);
        
        // if post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
        
                // save history
                $this->SetWorkorderHistory($this->getRequest()
                    ->getUri(), 'DELETE', $this->identity()
                    ->getAuthId(), 'Deleted file ' . $workorderFileEntity->getFileEntity()->getFileName() . ' from work order #' . $workorderId, $workorderId);
                
                // unlink the file
                $path = APPLICATION_PATH . '/' . $workorderFileEntity->getFileEntity()->getFilePath() . $workorderFileEntity->getFileEntity()->getFileName();
                
                if(is_file($path)) {
                    unlink($path);
                }
                
                // delete from the database
                $this->fileService->delete($workorderFileEntity->getFileEntity());
                             
                // set falsh messenger
                $this->flashmessenger()->addSuccessMessage('The file was deleted');                
            }
        
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $id,
                'workorderId' => $workorderId
            ));
        }
        
        // set up view
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Remove File From Work Order');
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        return new ViewModel(array(
            'workorderFileEntity' => $workorderFileEntity
        ));
    }
}

