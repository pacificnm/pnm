<?php
namespace Notification;


use Zend\Mvc\MvcEvent;

class Module
{
    /**
     *
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
    
        $sharedEventManager = $eventManager->getSharedManager();
    
        $sharedEventManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', array(
            $this,
            'NotificationEventController'
        ), 80);
    }
    
    /**
     *
     * @param MvcEvent $e
     */
    public function NotificationEventController(MvcEvent $e)
    {
        $controller = $e->getTarget();
    
        $controller->getEventManager()->attachAggregate($controller->getServiceLocator()
            ->get('Notification\Listener\NotificationListener'));
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
