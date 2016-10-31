<?php
namespace Subscription\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Subscription\Service\SubscriptionService;

class SubscriptionServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Subscription\Service\SubscriptionService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Subscription\Mapper\MysqlMapperInterface');
        
        return new SubscriptionService($mapper);
    }
}