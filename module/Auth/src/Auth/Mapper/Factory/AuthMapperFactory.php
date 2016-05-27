<?php
namespace Auth\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Auth\Mapper\AuthMapper;
use Auth\Hydrator\AuthHydrator;
use Auth\Entity\AuthEntity;

class AuthMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new AuthHydrator());
        
        $prototype = new AuthEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new AuthMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}