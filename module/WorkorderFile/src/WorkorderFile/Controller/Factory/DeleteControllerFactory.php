<?php
namespace WorkorderFile\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderFile\Controller\DeleteController;

class DeleteControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderFile\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $workorderFileService = $realServiceLocator->get('WorkorderFile\Service\WorkorderFileServiceInterface');
        
        $fileService = $realServiceLocator->get('File\Service\FileServiceInterface');
        
        return new DeleteController($clientService, $workorderService, $workorderFileService, $fileService);
    }
}

