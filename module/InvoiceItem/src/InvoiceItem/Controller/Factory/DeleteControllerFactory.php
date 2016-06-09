<?php
namespace InvoiceItem\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use InvoiceItem\Controller\DeleteController;

class DeleteControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
       
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $invoiceService = $realServiceLocator->get('Invoice\Service\InvoiceServiceInterface');
        
        $itemService = $realServiceLocator->get('InvoiceItem\Service\ItemServiceInterface');
        
        
        return new DeleteController($clientService, $invoiceService, $itemService);
    }

}