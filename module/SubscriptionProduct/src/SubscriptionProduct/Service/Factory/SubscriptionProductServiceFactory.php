<?php
namespace SubscriptionProduct\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionProduct\Service\SubscriptionProductService;

class SubscriptionProductServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionProduct\Service\SubscriptionProductService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('SubscriptionProduct\Mapper\MysqlMapperInterface');
        
        return new SubscriptionProductService($mapper);
    }
}

