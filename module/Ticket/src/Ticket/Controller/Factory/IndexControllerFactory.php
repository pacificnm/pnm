<?php
namespace Ticket\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Controller\IndexController;

class IndexControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Ticket\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $ticketService = $realServiceLocator->get('Ticket\Service\TicketServiceInterface');
        
        return new IndexController($ticketService);
    }
}

