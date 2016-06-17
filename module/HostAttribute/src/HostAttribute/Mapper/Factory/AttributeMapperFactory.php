<?php
namespace HostAttribute\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use HostAttribute\Mapper\AttributeMapper;
use HostAttribute\Hydrator\AttributeHydrator;
use HostAttribute\Entity\AttributeEntity;

class AttributeMapperFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new AttributeHydrator());
        
        $prototype = new AttributeEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        
        return new AttributeMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}