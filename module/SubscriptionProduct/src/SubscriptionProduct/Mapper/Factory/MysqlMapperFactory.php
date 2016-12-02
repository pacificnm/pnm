<?php
namespace SubscriptionProduct\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionProduct\Mapper\MysqlMapper;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use SubscriptionProduct\Hydrator\SubscriptionProductHydrator;
use SubscriptionProduct\Entity\SubscriptionProductEntity;

class MysqlMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionProduct\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new SubscriptionProductHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new SubscriptionProductEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

