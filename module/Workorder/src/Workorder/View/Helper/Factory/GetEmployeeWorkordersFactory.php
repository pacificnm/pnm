<?php
namespace Workorder\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Workorder\View\Helper\GetEmployeeWorkorders;
class GetEmployeeWorkordersFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Workorder\View\Helper\GetEmployeeWorkorders
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $workorderService = $realServiceLocator->get('WorkorderEmployee\Service\WorkorderEmployeeServiceInterface');
        
        return new GetEmployeeWorkorders($workorderService);
    }
}