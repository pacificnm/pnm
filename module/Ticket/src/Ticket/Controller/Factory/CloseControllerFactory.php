<?php
namespace Ticket\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Controller\CloseController;

class CloseControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Ticket\Controller\CloseController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $ticketService = $realServiceLocator->get('Ticket\Service\TicketServiceInterface');
        
        return new CloseController($ticketService);
    }
}

