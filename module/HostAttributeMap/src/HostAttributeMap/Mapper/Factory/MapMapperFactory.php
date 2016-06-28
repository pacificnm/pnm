<?php
namespace HostAttributeMap\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use HostAttributeMap\Mapper\MapMapper;
use HostAttributeMap\Hydrator\MapHydrator;
use HostAttributeMap\Entity\MapEntity;

class MapMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new MapHydrator());
        
        $prototype = new MapEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new MapMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}
