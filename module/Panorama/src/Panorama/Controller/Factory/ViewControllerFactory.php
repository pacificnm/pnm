<?php
namespace Panorama\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\Controller\ViewController;

class ViewControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Panorama\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $mspService = $realServiceLocator->get('Panorama\Service\MspServiceInterface');

        $deviceService = $realServiceLocator->get('Panorama\Service\DeviceServiceInterface');
        
        $panoramaClientService = $realServiceLocator->get('PanoramaClient\Service\PanoramaClientServiceInterface');
        
        return new ViewController($mspService, $deviceService, $panoramaClientService);
    }
}