<?php
namespace Invoice\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Invoice\Controller\CreateController;
use Invoice\Form\InvoiceForm;

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
        
        $invoiceForm = new InvoiceForm();
        
        return new CreateController($clientService, $invoiceService, $invoiceForm);
    }
}