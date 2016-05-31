<?php
namespace Invoice\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Invoice\Mapper\InvoiceMapper;
use Invoice\Hydrator\InvoiceHydrator;
use Invoice\Entity\InvoiceEntity;

class InvoiceMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new InvoiceHydrator());
        
        $prototype = new InvoiceEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new InvoiceMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}