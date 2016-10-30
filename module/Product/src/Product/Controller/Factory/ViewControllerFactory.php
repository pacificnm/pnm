<?php
namespace Product\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Product\Controller\ViewController;

class ViewControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Product\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $productService = $realServiceLocator->get('Product\Service\ProductServiceInterface');
        
        return new ViewController($productService);
    }
}