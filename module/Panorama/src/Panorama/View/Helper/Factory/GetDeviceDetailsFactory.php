<?php
namespace Panorama\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\View\Helper\GetDeviceDetails;
class GetDeviceDetailsFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Panorama\View\Helper\GetDeviceDetails
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $deviceService = $realServiceLocator->get('Panorama\Service\DeviceServiceInterface');
        
        return new GetDeviceDetails($deviceService);
    }
}