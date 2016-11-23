<?php
namespace SubscriptionHost\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionHost\View\Helper\GetSubscriptionHosts;
class GetSubscriptionHostsFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionHost\View\Helper\GetSubscriptionHosts
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $subscriptionHostService = $realServiceLocator->get('SubscriptionHost\Service\SubscriptionHostServiceInterface');
        
        return new GetSubscriptionHosts($subscriptionHostService);
    }
}