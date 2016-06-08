<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

use Zend\Mvc\ModuleRouteListener;
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
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        // catch errors
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array(
            $this,
            'onDispatchError'
        ), 100);
        
        $eventManager->attach(MvcEvent::EVENT_RENDER_ERROR, array(
            $this,
            'onDispatchError'
        ), 100);
    }

    /**
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     *
     * @param MvcEvent $e            
     */
    function onDispatchError(MvcEvent $e)
    {
        $viewModel = $e->getViewModel();
        $viewModel->setTemplate('layout/error');
        
        $sm = $e->getApplication()->getServiceManager();
        
        $logger = new \Zend\Log\Logger();
        $writer = new \Zend\Log\Writer\Stream('./data/log/' . date('Y-m-d') . '-error.log');
        $logger->addWriter($writer);
        
        // log error
        if ($e->getParam('exception')) {
            $ex = $e->getParam('exception');
            $logger->crit(sprintf("%s:%d %s (%d) [%s]", $ex->getFile(), $ex->getLine(), $ex->getMessage(), $ex->getCode(), get_class($ex)));
        }
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
