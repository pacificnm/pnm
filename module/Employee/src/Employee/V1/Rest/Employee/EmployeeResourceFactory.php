<?php
namespace Employee\V1\Rest\Employee;

use Zend\ServiceManager\ServiceLocatorInterface;

class EmployeeResourceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $services            
     * @return \Employee\V1\Rest\Employee\EmployeeResource
     */
    public function __invoke(ServiceLocatorInterface $services)
    {
        $employeeService = $services->get('Employee\Service\EmployeeServiceInterface');
        
        $config = $services->get('config');
        
        return new EmployeeResource($employeeService, $config);
    }
}
