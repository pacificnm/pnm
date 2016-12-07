<?php
namespace SubscriptionUser\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionUser\Form\SubscriptionUserForm;

class SubscriptionUserFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionUser\Form\SubscriptionUserForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $userService = $serviceLocator->get('User\Service\UserServiceInterface');
        
        return new SubscriptionUserForm($userService);
    }
}

