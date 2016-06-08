<?php
namespace Workorder\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Workorder\Controller\CompleteController;
use Workorder\Form\CompleteForm;

class CompleteControllerFactory implements FactoryInterface
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
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $timeService = $realServiceLocator->get('WorkorderTime\Service\TimeServiceInterface');
        
        $partService = $realServiceLocator->get('WorkorderPart\Service\PartServiceInterface');
        
        $invoiceService = $realServiceLocator->get('Invoice\Service\InvoiceServiceInterface');
        
        $itemService = $realServiceLocator->get('InvoiceItem\Service\ItemServiceInterface');
        
        $optionService = $realServiceLocator->get('InvoiceOption\Service\OptionServiceInterface');
        
        $completeForm = new CompleteForm();
        
        return new CompleteController($clientService, $workorderService, $timeService, $partService, $invoiceService, $itemService, $optionService, $completeForm);
    }
}