<?php
namespace ProductType\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ProductType\Controller\DeleteController;
class DeleteControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \ProductType\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('ProductType\Service\ProductTypeServiceInterface');
        
        return new DeleteController($service);
    }
}

