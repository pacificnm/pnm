<?php
namespace WorkorderTime\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderTime\Form\TimeForm;

class TimeFormFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $employeeService = $serviceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        $laborService = $serviceLocator->get('Labor\Service\LaborServiceInterface');
        
        return new TimeForm($employeeService, $laborService);
    }
}
