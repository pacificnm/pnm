<?php
namespace SubscriptionProduct\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionProduct\Controller\ViewController;

class ViewControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionProduct\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('SubscriptionProduct\Service\SubscriptionProductServiceInterface');
        
        $subscriptionService = $realServiceLocator->get('Subscription\Service\SubscriptionServiceInterface');
        
        return new ViewController($service, $subscriptionService);
    }
}

