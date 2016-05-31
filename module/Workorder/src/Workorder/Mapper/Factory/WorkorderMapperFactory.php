<?php
namespace Workorder\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Workorder\Mapper\WorkorderMapper;
use Workorder\Hydrator\WorkorderHydrator;
use Workorder\Entity\WorkorderEntity;

class WorkorderMapperFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new WorkorderHydrator());
        
        $prototype = new WorkorderEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new WorkorderMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}
