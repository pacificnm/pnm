<?php
namespace File\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use File\Controller\CreateController;
use File\Form\FileForm;
class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \File\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $fileService = $realServiceLocator->get('File\Service\FileServiceInterface');
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $fileForm = new FileForm();
        
        return new CreateController($clientService, $fileService, $fileForm);
    }
}
