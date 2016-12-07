<?php
namespace SubscriptionUser\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionUser\Service\SubscriptionUserService;

class SubscriptionUserServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionUser\Service\SubscriptionUserService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('SubscriptionUser\Mapper\MysqlMapperInterface');
        
        return new SubscriptionUserService($mapper);
    }
}

