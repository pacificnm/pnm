<?php
namespace Ticket;

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
        $sharedManager = $eventManager->getSharedManager();
        $sm = $e->getApplication()->getServiceManager();
        
        $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function ($e) use($sm) {
            $controller = $e->getTarget();
            $controller->getEventManager()
                ->attachAggregate($sm->get('Ticket\Listener\TicketListener'));
        }, 10);
    }

    /**
     * @return string
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * 
     * @return string[][][]
     */
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
