<?php
namespace WorkorderHistory\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use WorkorderHistory\Mapper\WorkorderHistoryMapper;
use WorkorderHistory\Hydrator\WorkorderHistoryHydrator;
use WorkorderHistory\Entity\WorkorderHistoryEntity;

class WorkorderHistoryMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderHistory\mapper\WorkorderHistoryMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new WorkorderHistoryHydrator());
        
        $prototype = new WorkorderHistoryEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new WorkorderHistoryMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

