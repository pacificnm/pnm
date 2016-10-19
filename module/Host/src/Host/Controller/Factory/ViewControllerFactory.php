<?php
namespace Host\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Host\Controller\ViewController;

class ViewControllerFactory
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $hostService = $realServiceLocator->get('Host\Service\HostServiceInterface');
        
        $mapService = $realServiceLocator->get('HostAttributeMap\Service\MapServiceInterface');
        
        $panoramaHostService = $realServiceLocator->get('PanoramaHost\Service\PanoramaHostServiceInterface');
        
        $panoramaClientService = $realServiceLocator->get('PanoramaClient\Service\PanoramaClientServiceInterface');
        
        return new ViewController($clientService, $hostService, $mapService, $panoramaHostService, $panoramaClientService);
    }
}