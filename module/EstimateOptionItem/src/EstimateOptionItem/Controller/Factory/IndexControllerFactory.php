<?php
namespace EstimateOptionItem\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use EstimateOptionItem\Controller\IndexController;

class IndexControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \EstimateOptionItem\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $estimateService = $realServiceLocator->get('Estimate\Service\EstimateServiceInterface');
        
        $optionService = $realServiceLocator->get('EstimateOption\Service\OptionServiceInterface');
        
        $itemService = $realServiceLocator->get('EstimateOptionItem\Service\ItemServiceInterface');
        
        return new IndexController($estimateService, $optionService, $itemService);
    }
}