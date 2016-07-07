<?php
namespace WorkorderEmployee\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderEmployee\Controller\DeleteController;
class DeleteControllerFactory
{
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $workorderService  = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $employeeService = $realServiceLocator->get('WorkorderEmployee\Service\WorkorderEmployeeServiceInterface');
        
        return new DeleteController($clientService, $workorderService, $employeeService);
    }
}

?>