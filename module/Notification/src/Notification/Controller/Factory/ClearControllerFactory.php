<?php
namespace Notification\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Notification\Controller\ClearController;

class ClearControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Notification\Controller\ClearController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $notificationService = $realServiceLocator->get('Notification\Service\NotificationServiceInterface');
        
        return new ClearController($notificationService);
    }
}