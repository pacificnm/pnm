<?php
namespace SubscriptionInvoice\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionInvoice\Service\SubscriptionInvoiceService;

class SubscriptionInvoiceServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionInvoice\Service\SubscriptionInvoiceService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('SubscriptionInvoice\Mapper\MysqlMapperInterface');
        
        return new SubscriptionInvoiceService($mapper);
    }
}