<?php
namespace WorkorderFile\Controller;

use Application\Controller\BaseController;
use Workorder\Service\WorkorderServiceInterface;
use File\Service\FileServiceInterface;
use WorkorderFile\Service\WorkorderFileServiceInterface;
use File\Form\FileForm;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
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
     * @var FileServiceInterface
     */
    protected $fileService;

    /**
     *
     * @var WorkorderFileServiceInterface
     */
    protected $workorderFileService;

    /**
     *
     * @var FileForm
     */
    protected $fileForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param WorkorderServiceInterface $workorderService            
     * @param FileServiceInterface $fileService            
     * @param WorkorderFileServiceInterface $workorderFileService            
     * @param FileForm $fileForm            
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, FileServiceInterface $fileService, WorkorderFileServiceInterface $workorderFileService, FileForm $fileForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->fileService = $fileService;
        
        $this->workorderFileService = $workorderFileService;
        
        $this->fileForm = $fileForm;
    }

    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
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
        
        // if we have a post
        if ($request->isPost()) {
            
            $postData = array_merge_recursive($this->getRequest()
                ->getPost()
                ->toArray(), $this->getRequest()
                ->getFiles()
                ->toArray());
            
            $this->fileForm->setData($postData);
            
            // if we are valid
            if ($this->fileForm->isValid()) {
                // save file
                $entity = $this->fileForm->getData();
                
                $path = 'data/files/client/' . $id . '/workorder/' . $workorderId . '/';
                
                $file = $entity->getFileName();
                
                $entity->setFileMime($file['type']);
                
                $entity->setFileSize($file['size']);
                
                $entity->setFilePath($path);
                
                if (! is_dir('./' . $path)) {
                    mkdir($path, 0777, true);
                }
                
                // move file
                rename($file['tmp_name'], './' . $path . $file['name']);
                
                $entity->setFileName($file['name']);
                
                $fileEntity = $this->fileService->save($entity);
                
                // map file
                $this->workorderFileService->createWorkorderFile($fileEntity->getFileId(), $workorderId);
                
                // save history
                $this->SetWorkorderHistory($this->getRequest()
                    ->getUri(), 'CREATE', $this->identity()
                    ->getAuthId(), 'Added file ' . $fileEntity->getFileName() . ' to work order #' . $workorderId, $workorderId);
                
                $this->flashMessenger()->addSuccessMessage('The file was saved');
                
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $id,
                    'workorderId' => $workorderId
                ));
            }
        }
        
        // set up form
        $this->fileForm->get('fileId')->setValue(0);
        
        $this->fileForm->get('authId')->setValue($this->identity()
            ->getAuthId());
        
        $this->fileForm->get('fileCreate')->setValue(time());
        
        // set up view
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Add File To Work Order');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        return new ViewModel(array(
            'form' => $this->fileForm
        ));
    }
}

