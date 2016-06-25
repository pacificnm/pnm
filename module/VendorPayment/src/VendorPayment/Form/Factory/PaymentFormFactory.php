<?php
namespace VendorPayment\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use VendorPayment\Form\PaymentForm;

class PaymentFormFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $accountService = $serviceLocator->get('Account\Service\AccountServiceInterface');
        
        return new PaymentForm($accountService);
    }
}
