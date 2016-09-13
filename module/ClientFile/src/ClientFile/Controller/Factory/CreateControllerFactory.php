<?php
namespace ClientFile\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ClientFile\Controller\CreateController;
use File\Form\FileForm;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \ClientFile\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $clientFileService = $realServiceLocator->get('ClientFile\Service\ClientFileServiceInterface');
        
        $fileService = $realServiceLocator->get('File\Service\FileServiceInterface');
        
        $fileForm = new FileForm();
        
        return new CreateController($clientService, $clientFileService, $fileService, $fileForm);
    }
}