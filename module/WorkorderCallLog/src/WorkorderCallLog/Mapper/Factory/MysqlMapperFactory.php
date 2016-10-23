<?php
namespace WorkorderCallLog\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCallLog\Mapper\MysqlMapper;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use WorkorderCallLog\Entity\WorkorderCallLogEntity;
use WorkorderCallLog\Hydrator\WorkorderCallLogHydrator;

class MysqlMapperFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderCallLog\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new WorkorderCallLogHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new WorkorderCallLogEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}