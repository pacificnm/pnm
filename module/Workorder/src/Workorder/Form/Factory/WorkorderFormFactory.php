<?php
namespace Workorder\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Workorder\Form\WorkorderForm;

class WorkorderFormFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $locationService = $serviceLocator->get('Location\Service\LocationServiceInterface');
        
        return new WorkorderForm($locationService);
    }
}