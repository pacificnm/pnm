<?php
namespace SubscriptionStatus\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionStatus\Mapper\MysqlMapper;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use SubscriptionStatus\Hydrator\SubscriptionStatusHydrator;
use SubscriptionStatus\Entity\SubscriptionStatusEntity;

class MysqlMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionStatus\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new SubscriptionStatusHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new SubscriptionStatusEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}