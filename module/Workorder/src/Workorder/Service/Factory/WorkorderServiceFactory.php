<?php
namespace Workorder\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Workorder\Service\WorkorderService;

class WorkorderServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Workorder\Service\WorkorderService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Workorder\Mapper\MysqlMapperInterface');
        
        return new WorkorderService($mapper);
    }
}
