<?php
namespace Invoice\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Invoice\Controller\ViewController;
use InvoiceItem\Form\ItemForm;


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
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $invoiceService = $realServiceLocator->get('Invoice\Service\InvoiceServiceInterface');
        
        $itemService = $realServiceLocator->get('InvoiceItem\Service\ItemServiceInterface');
        
        $optionService = $realServiceLocator->get('InvoiceOption\Service\OptionServiceInterface');
        
        $paymentService = $realServiceLocator->get('InvoicePayment\Service\PaymentServiceInterface');
        
        $locationService = $realServiceLocator->get('Location\Service\LocationServiceInterface');
        
        $phoneService = $realServiceLocator->get('Phone\Service\PhoneServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $itemForm = new ItemForm();
        
        $paymentForm = $realServiceLocator->get('InvoicePayment\Form\PaymentForm');
        
        return new ViewController($clientService, $invoiceService, $itemService, $optionService, $paymentService, $locationService, $phoneService, $workorderService, $itemForm, $paymentForm);
    }
}