<?php
namespace HostFile\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use HostFile\Mapper\HostFileMapper;
use HostFile\Hydrator\HostFileHydrator;
use HostFile\Entity\HostFileEntity;

class HostFileMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \HostFile\Mapper\HostFileMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new HostFileHydrator());
        
        $prototype = new HostFileEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new HostFileMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}
