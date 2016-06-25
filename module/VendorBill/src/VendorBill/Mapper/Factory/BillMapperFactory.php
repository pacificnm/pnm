<?php
namespace VendorBill\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use VendorBill\Mapper\BillMapper;
use VendorBill\Hydrator\BillHydrator;
use VendorBill\Entity\BillEntity;

class BillMapperFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new BillHydrator());
        
        $prototype = new BillEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new BillMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}