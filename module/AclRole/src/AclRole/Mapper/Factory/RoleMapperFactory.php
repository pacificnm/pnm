<?php
namespace AclRole\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use AclRole\Mapper\RoleMapper;
use AclRole\Hydrator\RoleHydrator;
use AclRole\Entity\RoleEntity;

class RoleMapperFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new RoleHydrator());
        
        $prototype = new RoleEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new RoleMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

