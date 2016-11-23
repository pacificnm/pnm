<?php
namespace Subscription\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Subscription\Controller\UpdateController;
class UpdateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Subscription\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $subscriptionService = $realServiceLocator->get('Subscription\Service\SubscriptionServiceInterface');
        
        $form = $realServiceLocator->get('Subscription\Form\SubscriptionForm');
        
        return new UpdateController($subscriptionService, $form);
    }
}