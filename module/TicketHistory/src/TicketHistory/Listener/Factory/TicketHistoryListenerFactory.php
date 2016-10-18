<?php
namespace TicketHistory\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use TicketHistory\Listener\TicketHistoryListener;

class TicketHistoryListenerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \TicketHistory\Listener\TicketHistoryListener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $ticketHistoryService = $serviceLocator->get('TicketHistory\Service\TicketHistoryServiceInterface');
        
        return new TicketHistoryListener($ticketHistoryService);
    }
}