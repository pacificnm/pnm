<?php
namespace WorkorderEmployee\Controller\Factory;

use WorkorderEmployee\Controller\CreateController;
use Zend\ServiceManager\ServiceLocatorInterface;

class CreateControllerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderEmployee\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $workorderService  = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $employeeService = $realServiceLocator->get('WorkorderEmployee\Service\WorkorderEmployeeServiceInterface');
        
        $employeeForm = $realServiceLocator->get('WorkorderEmployee\Form\WorkorderEmployeeForm');
        
        return new CreateController($clientService, $workorderService, $employeeService, $employeeForm);
    }
}
