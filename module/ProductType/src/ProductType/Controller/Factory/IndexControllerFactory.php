<?php
namespace ProductType\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ProductType\Controller\IndexController;

/**
 *
 * @author jaimie
 *        
 */
class IndexControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \ProductType\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('ProductType\Service\ProductTypeServiceInterface');
        
        return new IndexController($service);
    }
}

