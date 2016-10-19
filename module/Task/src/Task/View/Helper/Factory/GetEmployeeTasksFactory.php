<?php
namespace Task\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Task\View\Helper\GetEmployeeTasks;
class GetEmployeeTasksFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Task\View\Helper\GetEmployeeTasks
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $taskService = $realServiceLocator->get('Task\Service\TaskServiceInterface');
        
        return new GetEmployeeTasks($taskService);
    }
}