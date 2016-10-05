<?php
namespace EmployeeEmail\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Employee\Mapper\EmployeeMapper;
use EmployeeEmail\Hydrator\EmployeeEmailHydrator;
use EmployeeEmail\Entity\EmployeeEmailEntity;

class EmployeeEmailMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Employee\Mapper\EmployeeMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new EmployeeEmailHydrator());
        
        $prototype = new EmployeeEmailEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new EmployeeMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}