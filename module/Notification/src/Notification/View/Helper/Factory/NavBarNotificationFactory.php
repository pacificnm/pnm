<?php
namespace Notification\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Notification\View\Helper\NavBarNotification;

class NavBarNotificationFactory
{

    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $notificationService = $realServiceLocator->get('Notification\Service\NotificationServiceInterface');
 
        return new NavBarNotification($notificationService);
    }
}