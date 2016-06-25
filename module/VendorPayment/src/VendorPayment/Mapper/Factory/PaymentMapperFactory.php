<?php
namespace VendorPayment\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use VendorPayment\Mapper\PaymentMapper;
use VendorPayment\Hydrator\PaymentHydrator;
use VendorPayment\Entity\PaymentEntity;

class PaymentMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new PaymentHydrator());
        
        $prototype = new PaymentEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new PaymentMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}