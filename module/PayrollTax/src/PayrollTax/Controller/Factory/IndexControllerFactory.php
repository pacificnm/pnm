<?php
namespace PayrollTax\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollTax\Controller\IndexController;

class IndexControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \PayrollTax\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServicelocator = $serviceLocator->getServiceLocator();
        
        $service = $realServicelocator->get('PayrollTax\Service\PayrollTaxServiceInterface');
        
        return new IndexController($service);
    }
}

