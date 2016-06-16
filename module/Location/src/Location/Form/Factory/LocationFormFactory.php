<?php
namespace Location\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Location\Form\LocationForm;

class LocationFormFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $locationService = $serviceLocator->get('Location\Service\LocationServiceInterface');
        
        return new LocationForm($locationService);
    }
}