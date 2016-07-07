<?php
namespace WorkorderEmployee\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderEmployee\Form\WorkorderEmployeeForm;

class WorkorderEmployeeFormFactory implements FactoryInterface
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
        
        $workorderEmployeeService = $serviceLocator->get('WorkorderEmployee\Service\WorkorderEmployeeServiceInterface');
        
        return new WorkorderEmployeeForm($employeeService, $workorderEmployeeService);
    }
}