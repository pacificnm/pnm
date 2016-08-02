<?php
namespace Ticket\Controller\Plugin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Controller\Plugin\TicketHistoryPlugin;

class TicketHistoryPluginFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Ticket\Controller\Plugin\TicketHistoryPlugin
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        
        return new TicketHistoryPlugin();        
    }
}

