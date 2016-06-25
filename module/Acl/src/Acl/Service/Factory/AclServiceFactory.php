<?php
namespace Acl\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Acl\Service\AclService;

class AclServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Acl\Mapper\AclMapperInterface');
        
        $memcached = $serviceLocator->get('memcached');
        
        return new AclService($mapper, $memcached);
    }
}