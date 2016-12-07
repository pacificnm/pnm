<?php
namespace SubscriptionHost\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionHost\Form\SubscriptionHostForm;

class SubscriptionHostFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionHost\Form\SubscriptionHostForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hostService = $serviceLocator->get('Host\Service\HostServiceInterface');
        
        return new SubscriptionHostForm($hostService);
    }
}

