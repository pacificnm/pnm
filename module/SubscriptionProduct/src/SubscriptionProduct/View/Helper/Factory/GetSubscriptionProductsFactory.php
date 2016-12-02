<?php
namespace SubscriptionProduct\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionProduct\View\Helper\GetSubscriptionProducts;

class GetSubscriptionProductsFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionProduct\View\Helper\GetSubscriptionProducts
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('SubscriptionProduct\Service\SubscriptionProductServiceInterface');
        
        $subscriptionService = $realServiceLocator->get('Subscription\Service\SubscriptionServiceInterface');
        
        return new GetSubscriptionProducts($service, $subscriptionService);
    }
}

