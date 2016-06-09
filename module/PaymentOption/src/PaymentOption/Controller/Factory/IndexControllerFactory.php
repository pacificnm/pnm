<?php
namespace PaymentOption\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use PaymentOption\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $optionService = $realServiceLocator->get('PaymentOption\Service\OptionServiceInterface');
        
        return new IndexController($optionService);
    }
}