<?php
namespace CallLogEmail;

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
            'callLogEmailEventController'
        ), 90);
    }
    
    /**
     *
     * @param MvcEvent $e
     */
    public function callLogEmailEventController(MvcEvent $e)
    {
        $controller = $e->getTarget();
    
        $controller->getEventManager()->attachAggregate($controller->getServiceLocator()
            ->get('CallLogEmail\Listener\CallLogEmailListener'));
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
