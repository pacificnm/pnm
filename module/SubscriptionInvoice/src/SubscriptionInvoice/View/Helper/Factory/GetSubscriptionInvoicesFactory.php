<?php
namespace SubscriptionInvoice\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionInvoice\View\Helper\GetSubscriptionInvoices;
class GetSubscriptionInvoicesFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionInvoice\View\Helper\GetSubscriptionInvoices
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $subscriptionInvoiceService = $realServiceLocator->get('SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface');
        
        return new GetSubscriptionInvoices($subscriptionInvoiceService);
    }
}