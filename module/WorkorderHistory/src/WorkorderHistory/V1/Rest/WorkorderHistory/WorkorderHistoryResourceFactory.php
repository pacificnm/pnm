<?php
namespace WorkorderHistory\V1\Rest\WorkorderHistory;

use Zend\ServiceManager\ServiceLocatorInterface;

class WorkorderHistoryResourceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $services
     * @return \WorkorderHistory\V1\Rest\WorkorderHistory\WorkorderHistoryResource
     */
    public function __invoke(ServiceLocatorInterface $services)
    {
        $workorderHistoryService = $services->get('WorkorderHistory\Service\WorkorderHistoryServiceInterface');
        
        return new WorkorderHistoryResource($workorderHistoryService);
    }
}
