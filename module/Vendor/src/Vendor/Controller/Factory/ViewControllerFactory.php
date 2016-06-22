<?php
namespace Vendor\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Vendor\Controller\ViewController;

class ViewControllerFactory implements FactoryInterface
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
        
        $vendorService = $realServiceLocator->get('Vendor\Service\VendorServiceInterface');
        
        return new ViewController($vendorService);
    }
}