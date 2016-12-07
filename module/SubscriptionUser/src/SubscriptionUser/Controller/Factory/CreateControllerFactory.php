<?php
namespace SubscriptionUser\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionUser\Controller\CreateController;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionUser\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('SubscriptionUser\Service\SubscriptionUserServiceInterface');
        
        $form = $realServiceLocator->get('SubscriptionUser\Form\SubscriptionUserForm');
        
        return new CreateController($service, $form);
    }
}

