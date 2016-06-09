<?php
namespace InvoicePayment\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use InvoicePayment\Controller\DeleteController;

class DeleteControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $invoiceService = $realServiceLocator->get('Invoice\Service\InvoiceServiceInterface');
        
        $paymentService = $realServiceLocator->get('InvoicePayment\Service\PaymentServiceInterface');
        
        return new DeleteController($clientService, $invoiceService, $paymentService);
    }
}
