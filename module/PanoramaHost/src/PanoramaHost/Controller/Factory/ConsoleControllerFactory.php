<?php
namespace PanoramaHost\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PanoramaHost\Controller\ConsoleController;

class ConsoleControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PanoramaHost\Controller\ConsoleController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $mspService = $realServiceLocator->get('Panorama\Service\MspServiceInterface');
        
        $panoramaClientService = $realServiceLocator->get('PanoramaClient\Service\PanoramaClientServiceInterface');
        
        $panoramaHostService = $realServiceLocator->get('PanoramaHost\Service\PanoramaHostServiceInterface');
        
        $hostService = $realServiceLocator->get('Host\Service\HostServiceInterface');
        
        $deviceService = $realServiceLocator->get('Panorama\Service\DeviceServiceInterface');
        
        $hostTypeService = $realServiceLocator->get('HostType\Service\TypeServiceInterface');
        
        $locationService = $realServiceLocator->get('Location\Service\LocationServiceInterface');
        
        return new ConsoleController($mspService, $panoramaClientService, $panoramaHostService, $hostService, $deviceService, $hostTypeService, $locationService);
    }
}