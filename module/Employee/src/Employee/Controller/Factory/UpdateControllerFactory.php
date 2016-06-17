<?php
namespace Employee\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Employee\Controller\UpdateController;
use Employee\Form\EmployeeForm;
use Employee\Form\ProfileForm;

class UpdateControllerFactory implements FactoryInterface
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
        
        $employeeForm = new EmployeeForm();
        
        $profileForm = new ProfileForm();
        
        return new UpdateController($employeeService, $authService, $employeeForm, $profileForm);
    }
}