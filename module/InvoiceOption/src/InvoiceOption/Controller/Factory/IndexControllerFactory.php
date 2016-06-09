<?php
namespace InvoiceOption\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use InvoiceOption\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $optionService = $realServiceLocator->get('InvoiceOption\Service\OptionServiceInterface');
        
        return new IndexController($optionService);
    }
}