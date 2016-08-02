<?php
namespace Ticket\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\View\Helper\TicketViewHelper;

class TicketViewHelperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Ticket\View\Helper\TicketViewHelper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $ticketService = $realServiceLocator->get('Ticket\Service\TicketServiceInterface');
        
        return new TicketViewHelper($ticketService);
    }
}

