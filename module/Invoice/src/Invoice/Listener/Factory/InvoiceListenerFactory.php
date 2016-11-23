<?php
namespace Invoice\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Invoice\Listener\InvoiceListener;

class InvoiceListenerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Invoice\Listener\InvoiceListener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $invoiceService = $serviceLocator->get('Invoice\Service\InvoiceServiceInterface');
        
        $itemService = $serviceLocator->get('InvoiceItem\Service\ItemServiceInterface');
        
        $subscriptionHostService = $serviceLocator->get('SubscriptionHost\Service\SubscriptionHostServiceInterface');
        
        $subscriptionInvoiceService = $serviceLocator->get('SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface');
        
        $productService = $serviceLocator->get('Product\Service\ProductServiceInterface');
        
        return new InvoiceListener($invoiceService, $itemService, $subscriptionHostService, $subscriptionInvoiceService, $productService);
    }
}
