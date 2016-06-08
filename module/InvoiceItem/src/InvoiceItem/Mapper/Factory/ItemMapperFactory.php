<?php
namespace InvoiceItem\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use InvoiceItem\Mapper\ItemMapper;
use InvoiceItem\Hydrator\ItemHydrator;
use InvoiceItem\Entity\ItemEntity;

class ItemMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new ItemHydrator());
        
        $prototype = new ItemEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new ItemMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}