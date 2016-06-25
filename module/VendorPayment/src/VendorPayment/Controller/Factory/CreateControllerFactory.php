<?php
namespace VendorPayment\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use VendorPayment\Controller\CreateController;

class CreateControllerFactory implements FactoryInterface
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
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        $vendorAccountService = $realServiceLocator->get('VendorAccount\Service\AccountServiceInterface');
        
        $billService = $realServiceLocator->get('VendorBill\Service\BillServiceInterface');
        
        $paymentForm = $realServiceLocator->get('VendorPayment\Form\PaymentForm');
        
        return new CreateController($vendorService, $paymentService, $accountService, $vendorAccountService, $billService, $paymentForm);
    }
}