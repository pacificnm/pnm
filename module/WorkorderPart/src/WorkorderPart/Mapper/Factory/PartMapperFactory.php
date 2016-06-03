<?php
namespace WorkorderPart\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use WorkorderPart\Mapper\PartMapper;
use WorkorderPart\Hydrator\PartHydrator;
use WorkorderPart\Entity\PartEntity;

class PartMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new PartHydrator());
        
        $prototype = new PartEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new PartMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}
