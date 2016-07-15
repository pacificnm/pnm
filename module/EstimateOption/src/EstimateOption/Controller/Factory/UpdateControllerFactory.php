<?php
namespace EstimateOption\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use EstimateOption\Controller\UpdateController;
use EstimateOption\Form\OptionForm;

class UpdateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \EstimateOption\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
    
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
    
        $estimateService = $realServiceLocator->get('Estimate\Service\EstimateServiceInterface');
    
        $optionService = $realServiceLocator->get('EstimateOption\Service\OptionServiceInterface');
    
        $optionForm = new OptionForm();
        
        return new UpdateController($clientService, $estimateService, $optionService, $optionForm);
    }
}
