<?php
namespace WorkorderCallLog\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCallLog\View\Helper\GetCallLogWorkorder;

class GetCallLogWorkorderFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderCallLog\View\Helper\GetCallLogWorkorder
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $workorderCallLogService = $realServiceLocator->get('WorkorderCallLog\Service\WorkorderCallLogServiceInterface');
        
        return new GetCallLogWorkorder($workorderCallLogService);
    }
}