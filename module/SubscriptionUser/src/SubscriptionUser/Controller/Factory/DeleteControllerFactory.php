<?php
namespace SubscriptionUser\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionUser\Controller\DeleteController;

class DeleteControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionUser\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('SubscriptionUser\Service\SubscriptionUserServiceInterface');
        
        return new DeleteController($service);
    }
}

