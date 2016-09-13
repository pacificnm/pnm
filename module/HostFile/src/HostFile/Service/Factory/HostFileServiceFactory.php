<?php
namespace HostFile\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use HostFile\Service\HostFileService;
class HostFileServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \HostFile\Service\HostFileService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('HostFile\Mapper\HostFileMapperInterface');
        
        return new HostFileService($mapper);
    }
}