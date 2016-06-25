<?php
namespace VendorPayment\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use VendorPayment\Service\PaymentService;

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
        $mapper = $serviceLocator->get('VendorPayment\Mapper\PaymentMapperInterface');
       
        return new PaymentService($mapper);
    }
}