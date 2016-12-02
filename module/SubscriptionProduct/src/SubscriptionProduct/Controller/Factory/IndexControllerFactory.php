<?php
namespace SubscriptionProduct\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionProduct\Controller\IndexController;

class IndexControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionProduct\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('SubscriptionProduct\Service\SubscriptionProductServiceInterface');
        
        return new IndexController($service);
    }
}

