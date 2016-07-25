<?php
namespace WorkorderOption\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderOption\Controller\IndexController;

class IndexControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderOption\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $optionService = $realServiceLocator->get('WorkorderOption\Service\OptionServiceInterface');
        
        return new IndexController($optionService);
    }
}

