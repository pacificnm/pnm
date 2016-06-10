<?php
namespace Invoice\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Invoice\Controller\WorkorderController;

class WorkorderControllerFactory implements FactoryInterface
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
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $partService = $realServiceLocator->get('WorkorderPart\Service\PartServiceInterface');
        
        $timeService = $realServiceLocator->get('WorkorderTime\Service\TimeServiceInterface');
        
        $workorderForm = $realServiceLocator->get('Invoice\Form\WorkorderForm');
        
        return new WorkorderController($clientService, $invoiceService, $itemService, $workorderService, $partService, $timeService, $workorderForm);
    }
}