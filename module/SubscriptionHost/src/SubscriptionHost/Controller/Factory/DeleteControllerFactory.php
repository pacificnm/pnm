<?php
namespace SubscriptionHost\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionHost\Controller\DeleteController;

class DeleteControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionHost\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $subscriptionHostService = $realServiceLocator->get('SubscriptionHost\Service\SubscriptionHostServiceInterface');
        
        return new DeleteController($subscriptionHostService);
    }
}