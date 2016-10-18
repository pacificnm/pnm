<?php
namespace TicketEmail\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use TicketEmail\Listener\TicketEmailListener;

class TicketEmailListenerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \TicketEmail\Listener\TicketEmailListener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $ticketEmailService = $serviceLocator->get('TicketEmail\Service\TicketEmailServiceInterface');
        
        return new TicketEmailListener($ticketEmailService);
    }
}