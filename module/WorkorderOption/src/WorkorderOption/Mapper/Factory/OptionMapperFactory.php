<?php
namespace WorkorderOption\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use WorkorderOption\Mapper\OptionMapper;
use WorkorderOption\Hydrator\OptionHydrator;
use WorkorderOption\Entity\OptionEntity;

class OptionMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderOption\Mapper\OptionMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new OptionHydrator());
        
        $prototype = new OptionEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new OptionMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

