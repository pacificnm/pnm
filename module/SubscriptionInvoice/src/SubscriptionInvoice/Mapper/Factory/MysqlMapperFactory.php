<?php
namespace SubscriptionInvoice\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionInvoice\Mapper\MysqlMapper;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use SubscriptionInvoice\Hydrator\SubscriptionInvoiceHydrator;
use SubscriptionInvoice\Entity\SubscriptionInvoiceEntity;

class MysqlMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionInvoice\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new SubscriptionInvoiceHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new SubscriptionInvoiceEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}