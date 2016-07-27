<?php
namespace WorkorderHost\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderHost\View\Helper\WorkorderHostViewHelper;

class WorkorderHostViewHelperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderHost\View\Helper\WorkorderHostViewHelper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $workorderHostService = $realServiceLocator->get('WorkorderHost\Service\WorkorderHostServiceInterface');
        
        $workorderHostForm = $realServiceLocator->get('WorkorderHost\Form\WorkorderHostForm');
        
        return new WorkorderHostViewHelper($workorderHostService, $workorderHostForm);
    }
}

