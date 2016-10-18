<?php
namespace Ticket\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Listener\TicketListener;

class TicketListenerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Ticket\Listener\TicketListener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $ticketService = $serviceLocator->get('Ticket\Service\TicketServiceInterface');
        
        return new TicketListener($ticketService);
    }
}