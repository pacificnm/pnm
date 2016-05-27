<?php
namespace Employee\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Employee\Mapper\EmployeeMapper;
use Employee\Hydrator\EmployeeHydrator;
use Employee\Entity\EmployeeEntity;

class EmployeeMapperFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new EmployeeHydrator());
        
        $prototype = new EmployeeEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        
        return new EmployeeMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}