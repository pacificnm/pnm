<?php
namespace Task\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Task\Form\TaskForm;

class TaskFormFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $priorityService = $serviceLocator->get('TaskPriority\Service\PriorityServiceInterface');
        
        $employeeService = $serviceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        return new TaskForm($priorityService, $employeeService);
    }
}