<?php
namespace EstimateOption\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use EstimateOption\Controller\CreateController;
use EstimateOption\Form\OptionForm;

class CreateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \EstimateOption\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $estimateService = $realServiceLocator->get('Estimate\Service\EstimateServiceInterface');
        
        $optionService = $realServiceLocator->get('EstimateOption\Service\OptionServiceInterface');
        
        $optionForm = new OptionForm();
        
        return new CreateController($clientService, $estimateService, $optionService, $optionForm);
    }
}
