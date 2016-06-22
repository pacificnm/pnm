<?php
namespace InvoicePayment\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use InvoicePayment\Controller\CreateController;

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
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $invoiceService = $realServiceLocator->get('Invoice\Service\InvoiceServiceInterface');
        
        $paymentService = $realServiceLocator->get('InvoicePayment\Service\PaymentServiceInterface');
        
        $clientAccountService = $realServiceLocator->get('ClientAccount\Service\AccountServiceInterface');
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        $ledgerService = $realServiceLocator->get('AccountLedger\Service\LedgerServiceInterface');
        
        $paymentForm = $realServiceLocator->get('InvoicePayment\Form\PaymentForm');
        
        return new CreateController($clientService, $invoiceService, $paymentService, $clientAccountService, $accountService, $ledgerService, $paymentForm);
    }
}