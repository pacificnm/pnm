<?php
namespace Auth\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\SignInController;
use Auth\Form\SignInForm;

class SignInControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $authService = $realServiceLocator->get('Zend\Authentication\AuthenticationService');
        
        $authAdapter = $realServiceLocator->get('Auth\Adapter\AuthAdapter');
        
        $signInForm = new SignInForm();
        
        $service = $realServiceLocator->get('Auth\Service\AuthServiceInterface');
        
        $employeeService = $realServiceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        $userService = $realServiceLocator->get('User\Service\UserServiceInterface');
        
        return new SignInController($authService, $authAdapter, $service, $employeeService, $userService, $signInForm);
    }
}
