<?php
namespace Notification\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Notification\Listener\NotificationListener;

class NotificationListenerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Notification\Listener\NotificationListener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $notificationService = $serviceLocator->get('Notification\Service\NotificationServiceInterface');
        
        return new NotificationListener($notificationService);
    }
}