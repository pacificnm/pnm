<?php
namespace WorkorderOption\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderOption\Controller\UpdateController;
use WorkorderOption\Form\OptionForm;

class UpdateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderOption\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $optionService = $realServiceLocator->get('WorkorderOption\Service\OptionServiceInterface');
        
        $optionForm = new OptionForm();
        
        return new UpdateController($optionService, $optionForm);
    }
}

