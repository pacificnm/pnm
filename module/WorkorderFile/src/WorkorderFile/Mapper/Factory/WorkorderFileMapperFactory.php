<?php
namespace WorkorderFile\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use WorkorderFile\Mapper\WorkorderFileMapper;
use WorkorderFile\Hydrator\WorkorderFileHydrator;
use WorkorderFile\Entity\WorkorderFileEntity;

class WorkorderFileMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderFile\Mapper\WorkorderFileMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new WorkorderFileHydrator());
        
        $prototype = new WorkorderFileEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');

        return new WorkorderFileMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

