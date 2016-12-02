<?php
namespace SubscriptionProduct\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionProduct\Controller\UpdateController;

class UpdateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionProduct\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('SubscriptionProduct\Service\SubscriptionProductServiceInterface');
        
        $form = $realServiceLocator->get('SubscriptionProduct\Form\SubscriptionProductForm');
        
        return new UpdateController($service, $form);
    }
}

