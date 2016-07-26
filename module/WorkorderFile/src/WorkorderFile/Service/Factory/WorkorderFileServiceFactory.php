<?php
namespace WorkorderFile\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderFile\Service\WorkorderFileService;

class WorkorderFileServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderFile\Service\WorkorderFileService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        
        $mapper = $serviceLocator->get('WorkorderFile\Mapper\WorkorderFileMapperInterface');
        
        return new WorkorderFileService($mapper);
    }
}

