<?php
namespace File\Controller;

use Application\Controller\BaseController;
use File\Service\FileServiceInterface;

class DownloadController extends BaseController
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
        
        $file = APPLICATION_PATH . '/' . $fileEntity->getFilePath() . '/' . $fileEntity->getFileName();
        
        $response = new \Zend\Http\Response\Stream();
        
        $response->setStream(fopen($file, 'r'));
        
        $response->setStatusCode(200);
        
        $response->setStreamName(basename($file));
        
        $headers = new \Zend\Http\Headers();
        
        $headers->addHeaders(array(
            'Content-Disposition' => 'attachment; filename="' . basename($file) .'"',
            'Content-Type' => 'application/octet-stream',
            'Content-Length' => filesize($file),
            'Expires' => '@0', // @0, because zf2 parses date as string to \DateTime() object
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public'
        ));
        
        $response->setHeaders($headers);
        
        return $response;
    }
}

