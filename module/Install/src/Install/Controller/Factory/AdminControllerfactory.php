<?php
namespace Install\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Install\Controller\AdminController;
use Employee\Service\EmployeeServiceInterface;
use Install\Form\AdminForm;

class AdminControllerfactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $authService = $realServiceLocator->get('Auth\Service\AuthServiceInterface');
        
        $employeeService = $realServiceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        $configService = $realServiceLocator->get('Config\Service\ConfigServiceInterface');
        
        $adminForm = new AdminForm();
        
        
        return new AdminController($authService, $employeeService, $configService, $adminForm);
    }
}
