<?php
namespace HostType\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use HostType\Mapper\TypeMapper;
use HostType\Entity\TypeEntity;
use HostType\Hydrator\TypeHydrator;

class TypeMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new TypeHydrator());
        
        $prototype = new TypeEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new TypeMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}