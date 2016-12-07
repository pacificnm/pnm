<?php
namespace SubscriptionUser\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionUser\Mapper\MysqlMapper;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use SubscriptionUser\Hydrator\SubscriptionUserHydrator;
use SubscriptionUser\Entity\SubscriptionUserEntity;

class MysqlMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionUser\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new SubscriptionUserHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new SubscriptionUserEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

