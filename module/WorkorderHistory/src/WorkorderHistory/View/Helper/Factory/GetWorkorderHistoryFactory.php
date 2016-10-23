<?php
namespace WorkorderHistory\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderHistory\View\Helper\GetWorkorderHistory;

class GetWorkorderHistoryFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderHistory\View\Helper\GetWorkorderHistory
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $workorderHsitoryService = $realServiceLocator->get('WorkorderHistory\Service\WorkorderHistoryServiceInterface');
        
        return new GetWorkorderHistory($workorderHsitoryService);
    }
}