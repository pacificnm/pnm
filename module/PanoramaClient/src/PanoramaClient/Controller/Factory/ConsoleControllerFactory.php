<?php
namespace PanoramaClient\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PanoramaClient\Controller\ConsoleController;
class ConsoleControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \PanoramaClient\Controller\ConsoleController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $mspService = $realServiceLocator->get('Panorama\Service\MspServiceInterface');
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $panoramaClientService = $realServiceLocator->get('PanoramaClient\Service\PanoramaClientServiceInterface');
        
        return new ConsoleController($mspService, $clientService, $panoramaClientService);
    }
}