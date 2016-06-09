<?php
namespace InvoicePayment\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use InvoicePayment\Form\PaymentForm;

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
        $optionService = $serviceLocator->get('PaymentOption\Service\OptionServiceInterface');
        
        return new PaymentForm($optionService);
    }
}