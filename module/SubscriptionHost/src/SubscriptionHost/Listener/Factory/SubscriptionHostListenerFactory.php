<?php
namespace SubscriptionHost\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionHost\Listener\SubscriptionHostListener;
class SubscriptionHostListenerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionHost\Listener\SubscriptionHostListener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        
        $hostService = $serviceLocator->get('Host\Service\HostServiceInterface');
        
        $subscriptionHostService = $serviceLocator->get('SubscriptionHost\Service\SubscriptionHostServiceInterface');
        
        return new SubscriptionHostListener($hostService, $subscriptionHostService);
    }
}
