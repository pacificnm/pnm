<?php
namespace WorkorderHistory\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderHistory\Service\WorkorderHsitoryService;

class WorkorderHistoryServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderHistory\service\WorkorderHsitoryService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('WorkorderHistory\Mapper\WorkorderHistoryMapperInterface');
        
        $historyService = $serviceLocator->get('History\Service\HistoryServiceInterface');
        
        return new WorkorderHsitoryService($mapper, $historyService);
    }
}

