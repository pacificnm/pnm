<?php
namespace Subscription\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Subscription\Controller\ConsoleController;

class ConsoleControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Subscription\Controller\ConsoleController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Subscription\Service\SubscriptionServiceInterface');
        
        $subscriptionProductService = $realServiceLocator->get('SubscriptionProduct\Service\SubscriptionProductServiceInterface');
        
        $subscriptionInvoiceService = $realServiceLocator->get('SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface');
        
        $invoiceService = $realServiceLocator->get('Invoice\Service\InvoiceServiceInterface');
        
        $itemService = $realServiceLocator->get('InvoiceItem\Service\ItemServiceInterface');
        
        return new ConsoleController($service, $subscriptionProductService, $subscriptionInvoiceService, $invoiceService, $itemService);
    }
}