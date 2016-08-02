<?php
namespace Ticket\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Controller\CreateController;
use Ticket\Form\UserForm;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Ticket\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $ticketService = $realServiceLocator->get('Ticket\Service\TicketServiceInterface');
        
        $userForm = new UserForm();
        
        return new CreateController($ticketService, $userForm);
    }
}

