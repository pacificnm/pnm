<?php
namespace EstimateOptionItem\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use EstimateOptionItem\Controller\DeleteController;

class DeleteControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \EstimateOptionItem\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $estimateService = $realServiceLocator->get('Estimate\Service\EstimateServiceInterface');
        
        $optionService = $realServiceLocator->get('EstimateOption\Service\OptionServiceInterface');
        
        $itemService = $realServiceLocator->get('EstimateOptionItem\Service\ItemServiceInterface');
        
        return new DeleteController($estimateService, $optionService, $itemService);
    }
}