<?php
namespace ProductType\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ProductType\Controller\CreateController;
use ProductType\Form\ProductTypeForm;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \ProductType\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('ProductType\Service\ProductTypeServiceInterface');
        
        $form = new ProductTypeForm();
        
        return new CreateController($service, $form);
    }
}

