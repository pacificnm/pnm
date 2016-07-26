<?php
namespace File\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use File\Controller\DownloadController;

class DownloadControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \File\Controller\DownloadController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $fileService = $realServiceLocator->get('File\Service\FileServiceInterface');
        
        return new DownloadController($fileService);
    }
}

