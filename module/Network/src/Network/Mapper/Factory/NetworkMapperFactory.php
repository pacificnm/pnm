<?php
namespace Network\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Network\Mapper\NetworkMapper;
use Network\Entity\NetworkEntity;
use Network\Hydrator\NetworkHydrator;

class NetworkMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new NetworkHydrator());
        
        $prototype = new NetworkEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new NetworkMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}