<?php
namespace WorkorderCallLog\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCallLog\View\Helper\GetWorkorderCallLog;
class GetWorkorderCallLogFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderCallLog\View\Helper\GetWorkorderCallLog
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $workorderCallLogService = $realServiceLocator->get('WorkorderCallLog\Service\WorkorderCallLogServiceInterface');
        
        return new GetWorkorderCallLog($workorderCallLogService);
    }
}