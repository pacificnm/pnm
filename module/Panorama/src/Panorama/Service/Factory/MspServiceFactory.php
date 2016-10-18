<?php
namespace Panorama\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\Service\MspService;
use Panorama\Entity\MspEntity;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Panorama\Hydrator\MspHydrator;

class MspServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Panorama\Service\MspService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $configService = $serviceLocator->get('Config\Service\ConfigServiceInterface');
        
        $config = $serviceLocator->get('config');
        
        $prototype = new MspEntity();
        
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new MspHydrator());
        
        $memcached = $serviceLocator->get('memcached');
        
        return new MspService($configService, $config['encryption-key'], $prototype, $hydrator, $memcached);
    }
}