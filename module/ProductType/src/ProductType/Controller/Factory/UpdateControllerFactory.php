<?php
namespace ProductType\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ProductType\Controller\UpdateController;
use ProductType\Form\ProductTypeForm;

class UpdateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \ProductType\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('ProductType\Service\ProductTypeServiceInterface');
        
        $form = new ProductTypeForm();
        
        return new UpdateController($service, $form);
    }
}

