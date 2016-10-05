<?php
namespace TicketNote\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use TicketNote\Controller\UpdateController;
class UpdateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \TicketNote\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $noteService = $realServiceLocator->get('TicketNote\Service\NoteServiceInterface');
        
        $ticketService = $realServiceLocator->get('Ticket\Service\TicketServiceInterface');
        
        return new UpdateController($noteService, $ticketService);
    }
}