<?php
namespace TicketEmail;

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
            'ticketEventController'
        ), 3);
    }

    /**
     * 
     * @param MvcEvent $e
     */
    public function ticketEventController(MvcEvent $e)
    {
        $controller = $e->getTarget();
        $controller->getEventManager()->attachAggregate($controller->getServiceLocator()
            ->get('TicketEmail\Listener\TicketEmailListener'));
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
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }
}
