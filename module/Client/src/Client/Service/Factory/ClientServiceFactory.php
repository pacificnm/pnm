<?php
namespace Client\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Client\Service\ClientService;

class ClientServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Client\Mapper\ClientMapperInterface');
        
        $memcached = $serviceLocator->get('memcached');
        
        return new ClientService($mapper, $memcached);
    }
}
