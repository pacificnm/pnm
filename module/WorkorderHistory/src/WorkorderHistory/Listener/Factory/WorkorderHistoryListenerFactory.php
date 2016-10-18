<?php
namespace WorkorderHistory\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderHistory\Listener\WorkorderHistoryListener;

class WorkorderHistoryListenerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderHistory\Listener\WorkorderHistoryListener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $workorderHistoryService = $serviceLocator->get('WorkorderHistory\Service\WorkorderHistoryServiceInterface');
        
        return new WorkorderHistoryListener($workorderHistoryService);
    }
}