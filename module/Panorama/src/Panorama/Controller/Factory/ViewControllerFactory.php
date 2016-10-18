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
        
        $issueService = $realServiceLocator->get('Panorama\Service\IssueServiceInterface');
        
        $deviceService = $realServiceLocator->get('Panorama\Service\DeviceServiceInterface');
        
        return new ViewController($mspService, $issueService, $deviceService);
    }
}