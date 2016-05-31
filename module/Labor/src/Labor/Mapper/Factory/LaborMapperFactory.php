<?php
namespace Labor\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Labor\Mapper\LaborMapper;
use Labor\Hydrator\LaborHydrator;
use Labor\Entity\LaborEntity;

class LaborMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new LaborHydrator());
        
        $prototype = new LaborEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new LaborMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}