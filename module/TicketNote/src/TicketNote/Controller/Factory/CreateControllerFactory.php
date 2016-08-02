<?php
namespace TicketNote\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use TicketNote\Controller\CreateController;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \TicketNote\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $noteService = $realServiceLocator->get('TicketNote\Service\NoteServiceInterface');
        
        $ticketService = $realServiceLocator->get('Ticket\Service\TicketServiceInterface');
        
        return new CreateController($noteService, $ticketService);
    }
}

