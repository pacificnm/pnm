<?php
namespace EmployeeEmail\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use EmployeeEmail\Service\EmployeeEmailService;

class EmployeeEmailServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \EmployeeEmail\Service\EmployeeEmailService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('EmployeeEmail\Mapper\EmployeeEmailMapperInterface');
        
        return new EmployeeEmailService($mapper);
    }
}