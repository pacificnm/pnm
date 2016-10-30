<?php
namespace Product\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Product\Controller\CreateController;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Product\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
    
        $productService = $realServiceLocator->get('Product\Service\ProductServiceInterface');
    
        return new CreateController($productService);
    }
}