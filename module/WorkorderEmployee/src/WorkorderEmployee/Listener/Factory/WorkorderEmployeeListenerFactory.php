<?php
namespace WorkorderEmployee\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderEmployee\Listener\WorkorderEmployeeListener;

class WorkorderEmployeeListenerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $workorderEmployeeService = $serviceLocator->get('WorkorderEmployee\Service\WorkorderEmployeeServiceInterface');
        return new WorkorderEmployeeListener($workorderEmployeeService);
    }
}