<?php
namespace Workorder\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Workorder\Controller\UpdateController;

class UpdateControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
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
        
        $workorderForm = $realServiceLocator->get('Workorder\Form\WorkorderForm');
        
        $workorderEmployeeForm = $realServiceLocator->get('WorkorderEmployee\Form\WorkorderEmployeeForm');
        
        return new UpdateController($clientService, $workorderService, $workorderEmployeeService, $locationService, $phoneService, $userService, $messageService, $employeeService, $workorderForm, $workorderEmployeeForm);
    }
}