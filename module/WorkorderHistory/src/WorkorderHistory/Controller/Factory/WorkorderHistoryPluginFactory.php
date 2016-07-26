<?php
namespace WorkorderHistory\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderHistory\Controller\Plugin\WorkorderHistoryPlugin;

class WorkorderHistoryPluginFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderHistory\Controller\Plugin\WorkorderHistoryPlugin
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $historyService = $realServiceLocator->get('History\Service\HistoryServiceInterface');
       
        $workorderHistoryService = $realServiceLocator->get('WorkorderHistory\Service\WorkorderHistoryServiceInterface');
      
        return new WorkorderHistoryPlugin($historyService, $workorderHistoryService);
    }
}

