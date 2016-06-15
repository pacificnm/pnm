<?php
namespace TaskPriority\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use TaskPriority\Mapper\PriorityMapper;
use TaskPriority\Hydrator\PriorityHydrator;
use TaskPriority\Entity\PriorityEntity;

class PriorityMapperFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new PriorityHydrator());
        
        $prototype = new PriorityEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new PriorityMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}