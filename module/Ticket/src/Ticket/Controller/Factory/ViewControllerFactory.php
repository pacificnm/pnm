<?php
namespace Ticket\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Controller\ViewController;

class ViewControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Ticket\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $ticketService = $realServiceLocator->get('Ticket\Service\TicketServiceInterface');
        
        return new ViewController($ticketService);
    }
}

