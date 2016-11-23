<?php
namespace SubscriptionHost\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionHost\Service\SubscriptionHostService;
class SubscriptionHostServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionHost\Service\SubscriptionHostService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('SubscriptionHost\Mapper\MysqlMapperInterface');
        
        return new SubscriptionHostService($mapper);
    }
}