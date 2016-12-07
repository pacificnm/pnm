<?php
namespace SubscriptionUser\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionUser\View\Helper\GetSubscriptionUsers;

class GetSubscriptionUsersFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionUser\View\Helper\GetSubscriptionUsers
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('SubscriptionUser\Service\SubscriptionUserServiceInterface');
        
        return new GetSubscriptionUsers($service);
    }
}

