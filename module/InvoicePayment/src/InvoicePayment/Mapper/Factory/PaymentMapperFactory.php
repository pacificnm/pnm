<?php
namespace InvoicePayment\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use InvoicePayment\Mapper\PaymentMapper;
use InvoicePayment\Hydrator\PaymentHydrator;
use InvoicePayment\Entity\PaymentEntity;

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
