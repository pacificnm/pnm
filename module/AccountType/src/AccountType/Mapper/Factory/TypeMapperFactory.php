<?php
namespace AccountType\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use AccountType\Mapper\TypeMapper;
use AccountType\Hydrator\TypeHydrator;
use AccountType\Entity\TypeEntity;

class TypeMapperFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new TypeHydrator());
        
        $prototype = new TypeEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new TypeMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}