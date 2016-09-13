<?php
namespace ClientFile\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ClientFile\Controller\IndexController;

class IndexControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \ClientFile\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $clientFileService = $realServiceLocator->get('ClientFile\Service\ClientFileServiceInterface');
        
        return new IndexController($clientService, $clientFileService);
    }
}