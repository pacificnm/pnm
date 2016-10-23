<?php
namespace WorkorderCallLog\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCallLog\Service\WorkorderCallLogService;

class WorkorderCallLogServiceFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderCallLog\Service\WorkorderCallLogService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('WorkorderCallLog\Mapper\MysqlMapperInterface');
        
        return new WorkorderCallLogService($mapper);
    }
}