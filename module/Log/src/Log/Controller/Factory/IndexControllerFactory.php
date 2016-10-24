<?php
namespace Log\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Log\Controller\IndexController;

class IndexControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Log\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $logService = $realServiceLocator->get('Log\Service\LogServiceInterface');
        
      
        
        return new IndexController($logService);
    }
}