<?php
namespace Product\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Product\Controller\IndexController;

class IndexControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Product\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $productService = $realServiceLocator->get('Product\Service\ProductServiceInterface');
        
        return new IndexController($productService);
    }
}