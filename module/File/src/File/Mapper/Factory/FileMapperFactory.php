<?php
namespace File\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use File\Mapper\FileMapper;
use File\Hydrator\FileHydrator;
use File\Entity\FileEntity;

class FileMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \File\Mapper\FileMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new FileHydrator());
        
        $prototype = new FileEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new FileMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

