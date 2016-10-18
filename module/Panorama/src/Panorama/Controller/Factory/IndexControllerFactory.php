<?php
namespace Panorama\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\Controller\IndexController;

class IndexControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Panorama\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $mspService = $realServiceLocator->get('Panorama\Service\MspServiceInterface');
        
        return new IndexController($mspService);
    }
}