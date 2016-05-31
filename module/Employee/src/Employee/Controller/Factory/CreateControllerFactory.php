<?php
namespace Employee\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Employee\Controller\CreateController;
use Employee\Form\EmployeeCreateForm;

class CreateControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $employeeService = $realServiceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        $authService = $realServiceLocator->get('Auth\Service\AuthServiceInterface');
        
        $employeeCreateForm = new EmployeeCreateForm();
        
        return new CreateController($employeeService, $authService, $employeeCreateForm);
    }
}