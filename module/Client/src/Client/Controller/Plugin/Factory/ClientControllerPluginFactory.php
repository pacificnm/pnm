<?php
namespace Client\Controller\Plugin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Client\Controller\Plugin\ClientControllerPlugin;

class ClientControllerPluginFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Client\Controller\Plugin\ClientControllerPlugin
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $controllerPluginManager = $realServiceLocator->get('ControllerPluginManager');
        
        return new ClientControllerPlugin($clientService, $controllerPluginManager);
    }
}

