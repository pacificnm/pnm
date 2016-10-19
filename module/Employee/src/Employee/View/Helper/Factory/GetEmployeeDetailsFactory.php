<?php
namespace Employee\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Employee\View\Helper\GetEmployeeDetails;

class GetEmployeeDetailsFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Employee\View\Helper\GetEmployeeDetails
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $employeeService = $realServiceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        return new GetEmployeeDetails($employeeService);
    }
}