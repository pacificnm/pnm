<?php
namespace SubscriptionStatus\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionStatus\Service\SubscriptionStatusService;
class SubscriptionStatusServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionStatus\Service\SubscriptionStatusService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('SubscriptionStatus\Mapper\MysqlMapperInterface');
        
        return new SubscriptionStatusService($mapper);
    }
}