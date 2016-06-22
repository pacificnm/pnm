<?php
namespace Vendor\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Vendor\Mapper\VendorMapper;
use Vendor\Hydrator\VendorHydrator;
use Vendor\Entity\VendorEntity;

class VendorMapperFactory implements FactoryInterface
{
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new VendorHydrator());
        
        $prototype = new VendorEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new VendorMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}