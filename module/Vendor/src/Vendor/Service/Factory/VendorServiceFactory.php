<?php
namespace Vendor\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Vendor\Service\VendorService;

class VendorServiceFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Vendor\Mapper\VendorMapperInterface');
        
        return new VendorService($mapper);
    }
}