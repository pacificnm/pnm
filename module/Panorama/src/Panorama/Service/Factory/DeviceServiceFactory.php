<?php
namespace Panorama\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\Service\DeviceService;
use Panorama\Entity\DeviceEntity;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Panorama\Hydrator\DeviceHydrator;

class DeviceServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Panorama\Service\DeviceService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $configService = $serviceLocator->get('Config\Service\ConfigServiceInterface');
        
        $config = $serviceLocator->get('config');
        
        $prototype = new DeviceEntity();
        
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new DeviceHydrator());
        
        $memcached = $serviceLocator->get('memcached');
        
        return new DeviceService($configService, $config['encryption-key'], $prototype, $hydrator, $memcached);
    }
}