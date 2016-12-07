<?php
namespace SubscriptionHost\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionHost\Controller\CreateController;

class CreateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionHost\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('SubscriptionHost\Service\SubscriptionHostServiceInterface');
        
        $form = $realServiceLocator->get('SubscriptionHost\Form\SubscriptionHostForm');
        
        return new CreateController($service, $form);
    }
}

