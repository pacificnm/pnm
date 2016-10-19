<?php
namespace Panorama\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\Service\UserService;
use Panorama\Entity\UserEntity;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Panorama\Hydrator\UserHydrator;

class UserServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Panorama\Service\UserService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $configService = $serviceLocator->get('Config\Service\ConfigServiceInterface');
        
        $config = $serviceLocator->get('config');
        
        $prototype = new UserEntity();
        
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new UserHydrator());
        
        $memcached = $serviceLocator->get('memcached');
        
        return new UserService($configService, $config['encryption-key'], $prototype, $hydrator, $memcached);
    }
}