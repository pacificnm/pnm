<?php
namespace WorkorderHost\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use WorkorderHost\Mapper\WorkorderHostMapper;
use WorkorderHost\Entity\WorkorderHostEntity;
use WorkorderHost\Hydrator\WorkorderHostHydrator;
use WorkorderHost\Mapper\MysqlMapper;


class MysqlMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderHost\Mapper\WorkorderHostMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new WorkorderHostHydrator());
        
        $prototype = new WorkorderHostEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

