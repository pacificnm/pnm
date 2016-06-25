<?php
namespace VendorBill\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use VendorBill\Controller\UpdateController;
use VendorBill\Form\BillForm;

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
        
        $billService = $realServiceLocator->get('VendorBill\Service\BillServiceInterface');
        
        $bilForm = new BillForm();
        
        return new UpdateController($vendorService, $billService, $bilForm);
    }
}