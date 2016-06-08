<?php
namespace Config\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Config\Service\ConfigService;

class ConfigServiceFactory implements FactoryInterface
{
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Config\Mapper\ConfigMapperInterface');
        
        $memcached = $serviceLocator->get('memcached');
        
        return new ConfigService($mapper, $memcached);
    }
}