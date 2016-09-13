<?php
namespace File\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use File\Controller\IndexController;
class IndexControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \File\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $fileService = $realServiceLocator->get('File\Service\FileServiceInterface');
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        return new IndexController($clientService, $fileService);
    }
}