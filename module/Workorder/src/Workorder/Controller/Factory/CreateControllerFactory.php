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
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $workorderEmployeeService = $realServiceLocator->get('WorkorderEmployee\Service\WorkorderEmployeeServiceInterface');
        
        $locationService = $realServiceLocator->get('Location\Service\LocationServiceInterface');
        
        $phoneService = $realServiceLocator->get('Phone\Service\PhoneServiceInterface');
        
        $userService = $realServiceLocator->get('User\Service\UserServiceInterface');
                
        $messageService = $realServiceLocator->get('Message\Service\MessageServiceInterface');
     
        $employeeService = $realServiceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        $creditService = $realServiceLocator->get('WorkorderCredit\Service\CreditServiceInterface');
        
        $workorderForm = $realServiceLocator->get('Workorder\Form\WorkorderForm');
        
        $workorderEmployeeForm = $realServiceLocator->get('WorkorderEmployee\Form\WorkorderEmployeeForm');
        
        return new CreateController($clientService, $workorderService, $workorderEmployeeService, $locationService, $phoneService, $userService, $messageService, $employeeService, $creditService, $workorderForm, $workorderEmployeeForm);
    }
}