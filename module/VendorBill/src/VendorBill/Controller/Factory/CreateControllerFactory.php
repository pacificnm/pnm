<?php
namespace VendorBill\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use VendorBill\Controller\CreateController;
use VendorBill\Form\BillForm;

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
        
        $billService = $realServiceLocator->get('VendorBill\Service\BillServiceInterface');
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        $vendorAccountService = $realServiceLocator->get('VendorAccount\Service\AccountServiceInterface');
        
        $paymentService = $realServiceLocator->get('VendorPayment\Service\PaymentServiceInterface');
        
        $bilForm = new BillForm();
        
        $paymentForm = $realServiceLocator->get('VendorPayment\Form\PaymentForm');
        
        return new CreateController($vendorService, $billService, $accountService, $vendorAccountService, $paymentService, $bilForm, $paymentForm);
    }
}
