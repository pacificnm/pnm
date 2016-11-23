<?php
namespace Subscription\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Subscription\Controller\CreateController;
use Subscription\Form\SubscriptionForm;

class CreateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Subscription\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $subscriptionService = $realServiceLocator->get('Subscription\Service\SubscriptionServiceInterface');
        
        $form = $realServiceLocator->get('Subscription\Form\SubscriptionForm');
        
        return new CreateController($subscriptionService, $form);
    }
}