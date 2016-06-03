<?php
namespace WorkorderTime\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use WorkorderTime\Mapper\TimeMapper;
use WorkorderTime\Hydrator\TimeHydrator;
use WorkorderTime\Entity\TimeEntity;

class TimeMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new TimeHydrator());
        
        $prototype = new TimeEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new TimeMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}