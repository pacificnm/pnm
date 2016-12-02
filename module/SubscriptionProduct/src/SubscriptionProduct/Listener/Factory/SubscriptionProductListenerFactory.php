<?php
namespace SubscriptionProduct\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionProduct\Listener\SubscriptionProductListener;

class SubscriptionProductListenerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionProduct\Listener\SubscriptionProductListener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $subscriptionService = $serviceLocator->get('Subscription\Service\SubscriptionServiceInterface');
        
        $subscriptionInvoiceService = $serviceLocator->get('SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface');
        
        $invoiceService = $serviceLocator->get('Invoice\Service\InvoiceServiceInterface');
        
        $itemService = $serviceLocator->get('InvoiceItem\Service\ItemServiceInterface');
        
        return new SubscriptionProductListener($subscriptionService, $subscriptionInvoiceService, $invoiceService, $itemService);
    }
}

