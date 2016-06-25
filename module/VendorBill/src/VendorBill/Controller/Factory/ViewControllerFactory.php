<?php
namespace VendorBill\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use VendorBill\Controller\ViewController;

class ViewControllerFactory implements FactoryInterface
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
        
        $paymentService = $realServiceLocator->get('VendorPayment\Service\PaymentServiceInterface');
        
        return new ViewController($vendorService, $billService, $paymentService);
    }
}