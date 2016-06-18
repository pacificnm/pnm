<?php
namespace HostAttributeValue\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use HostAttributeValue\Mapper\ValueMapper;
use HostAttributeValue\Hydrator\ValueHydrator;
use HostAttributeValue\Entity\ValueEntity;

class ValueMapperFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new ValueHydrator());
        
        $prototype = new ValueEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new ValueMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}