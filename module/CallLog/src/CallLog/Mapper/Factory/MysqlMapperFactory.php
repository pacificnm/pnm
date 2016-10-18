<?php
namespace CallLog\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use CallLog\Mapper\MysqlMapper;
use CallLog\Hydrator\LogHydrator;
use CallLog\Entity\LogEntity;
class MysqlMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \CallLog\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new LogHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new LogEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}