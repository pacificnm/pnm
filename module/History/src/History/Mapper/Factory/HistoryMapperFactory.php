<?php
namespace History\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use History\Mapper\HistoryMapper;
use History\Hydrator\HistoryHydrator;
use History\Entity\HistoryEntity;

class HistoryMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new HistoryHydrator());
        
        $prototype = new HistoryEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new HistoryMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}