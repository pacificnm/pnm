<?php
namespace InvoiceItem\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use InvoiceItem\Service\ItemService;

class ItemServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('InvoiceItem\Mapper\ItemMapperInterface');
        
        return new ItemService($mapper);
    }
}