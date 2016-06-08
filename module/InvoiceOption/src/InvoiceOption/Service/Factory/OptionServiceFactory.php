<?php
namespace InvoiceOption\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use InvoiceOption\Service\OptionsService;

class OptionServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('InvoiceOption\Mapper\OptionMapperInterface');
        
        return new OptionsService($mapper);
    }
}