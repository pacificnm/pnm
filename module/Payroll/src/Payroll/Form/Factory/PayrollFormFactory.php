<?php
namespace Payroll\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Payroll\Form\PayrollForm;

class PayrollFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Payroll\Form\PayrollForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $employeeService = $serviceLocator->get('Employee\Service\EmployeeServiceInterface');
        return new PayrollForm($employeeService);
    }
}