<?php
namespace SubscriptionProduct\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionProduct\Controller\CreateController;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionProduct\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('SubscriptionProduct\Service\SubscriptionProductServiceInterface');
        
        $form = $realServiceLocator->get('SubscriptionProduct\Form\SubscriptionProductForm');
        
        return new CreateController($service, $form);
    }
}

