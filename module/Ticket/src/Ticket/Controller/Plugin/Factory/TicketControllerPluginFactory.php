<?php
namespace Ticket\Controller\Plugin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Controller\Plugin\TicketControllerPlugin;

class TicketControllerPluginFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Ticket\Controller\Plugin\TicketControllerPlugin
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $ticketService = $realServiceLocator->get('Ticket\Service\TicketServiceInterface');
        
        $controllerPluginManager = $realServiceLocator->get('ControllerPluginManager');
        
        return new TicketControllerPlugin($ticketService, $controllerPluginManager);
    }
}

