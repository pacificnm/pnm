<?php
namespace InvoicePayment\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use InvoicePayment\Service\PaymentService;

class PaymentServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('InvoicePayment\Mapper\PaymentMapperInterface');
        
        return new PaymentService($mapper);
    }
}