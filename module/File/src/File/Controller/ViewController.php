<?php
namespace File\Controller;

use Application\Controller\BaseController;
use File\Service\FileServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
{
    /**
     * 
     * @var FileServiceInterface
     */
    protected $fileService;
    
    /**
     * 
     * @param FileServiceInterface $fileService
     */
    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $fileId = $this->params()->fromRoute('fileId');
        
        $fileEntity = $this->fileService->get($fileId);
        
        return new ViewModel(array(
            'fileEntity' => $fileEntity
        ));
    }
}

