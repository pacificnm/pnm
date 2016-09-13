<?php
namespace ClientFile\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use ClientFile\Service\ClientFileServiceInterface;
use File\Service\FileServiceInterface;
use File\Form\FileForm;
use Zend\View\Model\ViewModel;
use ClientFile\Entity\ClientFileEntity;

class CreateController extends BaseController
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
     * @param ClientFileServiceInterface $clientFileService            
     * @param FileServiceInterface $fileService            
     * @param FileForm $fileForm            
     */
    public function __construct(ClientServiceInterface $clientService, ClientFileServiceInterface $clientFileService, FileServiceInterface $fileService, FileForm $fileForm)
    {
        $this->clientService = $clientService;
        
        $this->clientFileService = $clientFileService;
        
        $this->fileService = $fileService;
        
        $this->fileForm = $fileForm;
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
        
        $request = $this->getRequest();
        
        $clientEntity = $this->clientService->get($clientId);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        // if we have a post
        if ($request->isPost()) {
            // merge post data and file data
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
                
                $path = 'data/files/client/' . $clientId . '/';
                
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
                
                // map to client
                $clientFileEntity = new ClientFileEntity();
                
                $clientFileEntity->setClientId($clientId);
                
                $clientFileEntity->setFileId($fileEntity->getFileId());
                
                $this->clientFileService->save($clientFileEntity);
                
                // set history
                
                $this->flashMessenger()->addSuccessMessage('The file was saved');
                
                return $this->redirect()->toRoute('client-file-index', array(
                    'clientId' => $clientId
                ));
            }
        }
        
        // set form vars
        $this->fileForm->get('authId')->setValue($this->identity()
            ->getAuthId());
        
        $this->fileForm->get('fileId')->setValue(0);
        
        $this->fileForm->get('fileCreate')->setValue(time());
        
        // set layout vars
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'Create File');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'client-file-index');
        
        // return view model
        return new ViewModel(array(
            'form' => $this->fileForm
        ));
    }
}