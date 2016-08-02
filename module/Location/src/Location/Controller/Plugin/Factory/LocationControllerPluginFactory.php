<?php
namespace Location\Controller\Plugin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Location\Controller\Plugin\LocationControllerPlugin;

class LocationControllerPluginFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Location\Controller\Plugin\LocationControllerPlugin
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $locationService = $realServiceLocator->get('Location\Service\LocationServiceInterface');
        
        return new LocationControllerPlugin($locationService);
    }
}

