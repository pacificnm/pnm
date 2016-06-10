<?php
namespace WorkorderCredit\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCredit\Form\CreditForm;

class CreditFormFactory implements FactoryInterface
{
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $optionService = $serviceLocator->get('PaymentOption\Service\OptionServiceInterface');
        
        return new CreditForm($optionService);
    }
}