<?php
namespace CallLog\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use CallLog\View\Helper\GetEmployeeCallLogs;
class GetEmployeeCallLogsFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \CallLog\View\Helper\GetEmployeeCallLogs
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $logService = $realServiceLocator->get('CallLog\Service\LogServiceInterface');
        
        return new GetEmployeeCallLogs($logService);
    }
}