<?php
namespace AclResource\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AclResource\Service\ResourceService;

class ResourceServiceFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('AclResource\Mapper\ResourceMapperInterface');
        
        $memcached = $serviceLocator->get('memcached');
        
        return new ResourceService($mapper, $memcached);
    }
}