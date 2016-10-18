<?php
namespace WorkorderEmail\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use WorkorderEmail\Mapper\MysqlMapper;
use WorkorderEmail\Hydrator\WorkorderEmailHydrator;
use WorkorderEmail\Entity\WorkorderEmailEntity;

class MysqlMapperFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new WorkorderEmailHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new WorkorderEmailEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}