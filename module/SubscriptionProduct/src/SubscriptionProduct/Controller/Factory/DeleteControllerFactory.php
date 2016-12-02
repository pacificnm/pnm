<?php
namespace SubscriptionProduct\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionProduct\Controller\DeleteController;

class DeleteControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionProduct\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('SubscriptionProduct\Service\SubscriptionProductServiceInterface');
        
        $subscriptionService = $realServiceLocator->get('Subscription\Service\SubscriptionServiceInterface');
        
        return new DeleteController($service, $subscriptionService);
    }
}

