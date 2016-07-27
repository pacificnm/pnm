<?php
namespace WorkorderHost\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderHost\Service\WorkorderHostService;

class WorkorderHostServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderHost\Service\WorkorderHostService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('WorkorderHost\Mapper\MysqlMapperInterface');
        
        return new WorkorderHostService($mapper);
    }
}

