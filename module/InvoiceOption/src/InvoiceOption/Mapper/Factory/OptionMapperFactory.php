<?php
namespace InvoiceOption\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use InvoiceOption\Mapper\OptionMapper;
use InvoiceOption\Hydrator\OptionHydrator;
use InvoiceOption\Entity\OptionEntity;

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