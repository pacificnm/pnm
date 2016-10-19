<?php
namespace Panorama\Controller\Factory;

use Panorama\Controller\DeviceController;
use Zend\ServiceManager\ServiceLocatorInterface;

class DeviceControllerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Panorama\Controller\DeviceController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $mspService = $realServiceLocator->get('Panorama\Service\MspServiceInterface');
        
        $deviceService = $realServiceLocator->get('Panorama\Service\DeviceServiceInterface');
        
        $panoramaHostService = $realServiceLocator->get('PanoramaHost\Service\PanoramaHostServiceInterface');
        
        $panoramaClientService = $realServiceLocator->get('PanoramaClient\Service\PanoramaClientServiceInterface');
        
        return new DeviceController($mspService, $deviceService, $panoramaHostService, $panoramaClientService);
    }
}