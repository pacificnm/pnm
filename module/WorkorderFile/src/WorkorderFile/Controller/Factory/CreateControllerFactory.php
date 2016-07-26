<?php
namespace WorkorderFile\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderFile\Controller\CreateController;
use File\Form\FileForm;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderFile\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $fileService = $realServiceLocator->get('File\Service\FileServiceInterface');
        
        $workorderFileService = $realServiceLocator->get('WorkorderFile\Service\WorkorderFileServiceInterface');
        
        $fileForm = new FileForm();
        
        return new CreateController($clientService, $workorderService, $fileService, $workorderFileService, $fileForm);
    }
}

