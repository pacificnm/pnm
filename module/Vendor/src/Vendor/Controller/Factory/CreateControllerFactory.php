<?php
namespace Vendor\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Vendor\Controller\CreateController;
use Vendor\Form\VendorForm;

class CreateControllerFactory implements FactoryInterface
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
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        $vendorAccountService = $realServiceLocator->get('VendorAccount\Service\AccountServiceInterface');
        
        $vendorForm = new VendorForm();
        
        return new CreateController($vendorService, $accountService, $vendorAccountService, $vendorForm);
    }
}