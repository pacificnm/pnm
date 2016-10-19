<?php
namespace Panorama\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\Service\IssueService;
use Panorama\Entity\IssueEntity;
use Panorama\Hydrator\IssueHydrator;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

class IssueServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Panorama\Service\IssueService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $configService = $serviceLocator->get('Config\Service\ConfigServiceInterface');
        
        $config = $serviceLocator->get('config');
        
        $prototype = new IssueEntity();
        
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new IssueHydrator());
        
        $memcached = $serviceLocator->get('memcached');
        
        return new IssueService($configService, $config['encryption-key'], $prototype, $hydrator, $memcached);
    }
}