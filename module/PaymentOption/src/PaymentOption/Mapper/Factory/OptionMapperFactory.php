<?php
namespace PaymentOption\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use PaymentOption\Mapper\OptionMapper;
use PaymentOption\Hydrator\OptionHydrator;
use PaymentOption\Entity\OptionEntity;

class OptionMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new OptionHydrator());
        
        $prototype = new OptionEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new OptionMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}