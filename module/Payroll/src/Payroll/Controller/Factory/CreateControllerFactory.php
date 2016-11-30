<?php
namespace Payroll\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Payroll\Controller\CreateController;

class CreateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Payroll\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Payroll\Service\PayrollServiceInterface');
        
        $payrollTaxService = $realServiceLocator->get('PayrollTax\Service\PayrollTaxServiceInterface');
        
        $employeeService = $realServiceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        $form = $realServiceLocator->get('Payroll\Form\PayrollForm');
        
        return new CreateController($service, $payrollTaxService, $employeeService, $form);
    }
}