<?php
namespace InvoiceItem\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use InvoiceItem\Controller\CreateController;
use InvoiceItem\Form\ItemForm;

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
        
        $itemService = $realServiceLocator->get('InvoiceItem\Service\ItemServiceInterface');
        
        $itemForm = new ItemForm();
        
        return new CreateController($clientService, $invoiceService, $itemService, $itemForm);
    }
}
