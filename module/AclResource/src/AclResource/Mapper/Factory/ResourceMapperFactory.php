<?php
namespace AclResource\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use AclResource\Mapper\ResourceMapper;
use AclResource\Hydrator\ResourceHydrator;
use AclResource\Entity\ResourceEntity;

class ResourceMapperFactory implements FactoryInterface
{
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new ResourceHydrator());
        
        $prototype = new ResourceEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new ResourceMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}