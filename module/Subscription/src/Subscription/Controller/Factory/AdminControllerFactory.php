<?php
namespace Subscription\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Subscription\Controller\AdminController;
class AdminControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Subscription\Controller\AdminController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $subscriptionService = $realServiceLocator->get('Subscription\Service\SubscriptionServiceInterface');
        
        return new AdminController($subscriptionService);
    }
}