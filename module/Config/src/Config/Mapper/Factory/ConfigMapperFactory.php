<?php
namespace Config\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Config\Mapper\ConfigMapper;
use Config\Hydrator\ConfigHydrator;
use Config\Entity\ConfigEntity;

class ConfigMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new ConfigHydrator());
        
        $prototype = new ConfigEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new ConfigMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}