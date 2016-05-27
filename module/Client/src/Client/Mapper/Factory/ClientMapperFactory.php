<?php
namespace Client\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Client\Mapper\ClientMapper;
use Client\Hydrator\ClientHydrator;
use Client\Entity\ClientEntity;

class ClientMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new ClientHydrator());
        
        $prototype = new ClientEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new ClientMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}
