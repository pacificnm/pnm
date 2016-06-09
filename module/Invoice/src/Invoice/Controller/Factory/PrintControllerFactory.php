<?php
namespace Invoice\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Invoice\Controller\PrintController;

class PrintControllerFactory implements FactoryInterface
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
        
        $optionService = $realServiceLocator->get('InvoiceOption\Service\OptionServiceInterface');
        
        $locationService = $realServiceLocator->get('Location\Service\LocationServiceInterface');
        
        $phoneService = $realServiceLocator->get('Phone\Service\PhoneServiceInterface');
        
        return new PrintController($clientService, $invoiceService, $itemService, $optionService, $locationService, $phoneService);
    }
}