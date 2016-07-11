<?php
namespace EstimateOptionItem\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use EstimateOptionItem\Controller\CreateController;
use EstimateOptionItem\Form\ItemForm;

class CreateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \EstimateOptionItem\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        
        $estimateService = $realServiceLocator->get('Estimate\Service\EstimateServiceInterface');
        
        $optionService = $realServiceLocator->get('EstimateOption\Service\OptionServiceInterface');
        
        $itemService = $realServiceLocator->get('EstimateOptionItem\Service\ItemServiceInterface');
        
        $itemForm = new ItemForm();
        
        return new CreateController($clientService, $estimateService, $optionService, $itemService, $itemForm);
    }
}