<?php
namespace EstimateOptionItem\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use EstimateOptionItem\Controller\UpdateController;
use EstimateOptionItem\Form\ItemForm;

class UpdateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \EstimateOptionItem\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $estimateService = $realServiceLocator->get('Estimate\Service\EstimateServiceInterface');
        
        $optionService = $realServiceLocator->get('EstimateOption\Service\OptionServiceInterface');
        
        $itemService = $realServiceLocator->get('EstimateOptionItem\Service\ItemServiceInterface');
        
        $itemForm = new ItemForm();
        
        return new UpdateController($estimateService, $optionService, $itemService, $itemForm);
    }
}