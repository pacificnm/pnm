<?php
namespace WorkorderCallLog\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCallLog\Form\WorkorderCallLogForm;
class WorkorderCallLogFormFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderCallLog\Form\WorkorderCallLogForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $workorderService = $serviceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        return new WorkorderCallLogForm($workorderService);
    }
}
