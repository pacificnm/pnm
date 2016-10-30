<?php
namespace Product\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Product\Controller\DeleteController;

class DeleteControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Product\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $productService = $realServiceLocator->get('Product\Service\ProductServiceInterface');
        
        return new DeleteController($productService);
    }
}