<?php
namespace Product\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Product\Controller\UpdateController;
use Product\Form\ProductForm;

class UpdateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Product\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $productService = $realServiceLocator->get('Product\Service\ProductServiceInterface');
        
        $form = new ProductForm();
        
        return new UpdateController($productService, $form);
    }
}