<?php
namespace Invoice\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Invoice\Form\WorkorderForm;

class WorkorderFormFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $workorderService = $serviceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        return new WorkorderForm($workorderService);
    }
}