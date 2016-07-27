<?php
namespace WorkorderHost\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderHost\Form\WorkorderHostForm;

class WorkorderHostFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderHost\Form\WorkorderHostForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hostService = $serviceLocator->get('Host\Service\HostServiceInterface');
        
        return new WorkorderHostForm($hostService);
    }
}

