<?php
namespace Host\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Host\Form\HostForm;

class HostFormFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $typeService = $serviceLocator->get('HostType\Service\TypeServiceInterface');
        
        $locationService = $serviceLocator->get('Location\Service\LocationServiceInterface');
        
        return new HostForm($typeService, $locationService);
    }
}