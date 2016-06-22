<?php
namespace Vendor\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Vendor\Controller\UpdateController;
use Vendor\Form\VendorForm;

class UpdateControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $vendorService = $realServiceLocator->get('Vendor\Service\VendorServiceInterface');
        
        $vendorForm = new VendorForm();
        
        return new UpdateController($vendorService, $vendorForm);
    }
}