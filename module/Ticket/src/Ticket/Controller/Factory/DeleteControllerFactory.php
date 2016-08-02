<?php
namespace Ticket\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Controller\DeleteController;

class DeleteControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Ticket\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $ticketService = $realServiceLocator->get('Ticket\Service\TicketServiceInterface');
        
        return new DeleteController($ticketService);
    }
}

