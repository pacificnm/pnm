<?php
namespace WorkorderHistory;

use Zend\Mvc\MvcEvent;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
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
            'workorderHistoryEventController'
        ), 100);
    }
    
    /**
     *
     * @param MvcEvent $e
     */
    public function workorderHistoryEventController(MvcEvent $e)
    {
        $controller = $e->getTarget();
    
        $controller->getEventManager()->attachAggregate($controller->getServiceLocator()
            ->get('WorkorderHistory\Listener\WorkorderHistoryListener'));
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
