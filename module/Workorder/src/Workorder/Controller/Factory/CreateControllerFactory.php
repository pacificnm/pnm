<?php
namespace Workorder\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Workorder\Controller\CreateController;

class CreateControllerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Workorder\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();

        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $workorderEmployeeService = $realServiceLocator->get('WorkorderEmployee\Service\WorkorderEmployeeServiceInterface');
                
        $messageService = $realServiceLocator->get('Message\Service\MessageServiceInterface');
     
        $employeeService = $realServiceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        $creditService = $realServiceLocator->get('WorkorderCredit\Service\CreditServiceInterface');
        
        $ticketService = $realServiceLocator->get('Ticket\Service\TicketServiceInterface');
        
        $workorderTicketService = $realServiceLocator->get('WorkorderTicket\Service\WorkorderTicketServiceInterface');
        
        $workorderForm = $realServiceLocator->get('Workorder\Form\WorkorderForm');
        
        $workorderEmployeeForm = $realServiceLocator->get('WorkorderEmployee\Form\WorkorderEmployeeForm');
        
        return new CreateController($workorderService, $workorderEmployeeService, $messageService, $employeeService, $creditService, $ticketService, $workorderTicketService, $workorderForm, $workorderEmployeeForm);
    }
}