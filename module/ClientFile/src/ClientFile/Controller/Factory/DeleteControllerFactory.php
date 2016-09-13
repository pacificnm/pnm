<?php
namespace ClientFile\Controller\Factory;
use Zend\ServiceManager\ServiceLocatorInterface;
use ClientFile\Controller\DeleteController;

class DeleteControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \ClientFile\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $clientFileService = $realServiceLocator->get('ClientFile\Service\ClientFileServiceInterface');
        
        $workorderFileService = $realServiceLocator->get('WorkorderFile\Service\WorkorderFileServiceInterface');
        
        $fileService = $realServiceLocator->get('File\Service\FileServiceInterface');
        
        return new DeleteController($clientService, $clientFileService, $workorderFileService, $fileService);
    }
}