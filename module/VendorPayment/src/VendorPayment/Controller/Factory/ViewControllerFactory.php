<?php
namespace VendorPayment\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use VendorPayment\Controller\ViewController;

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
        
        $paymentService = $realServiceLocator->get('VendorPayment\Service\PaymentServiceInterface');
        
        $billService = $realServiceLocator->get('VendorBill\Service\BillServiceInterface');
        
        return new ViewController($vendorService, $paymentService, $billService);
    }
}