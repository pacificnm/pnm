<?php
namespace PayrollDeductionType\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeductionType\Controller\IndexController;

class IndexControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PayrollDeductionType\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface');
        
        return new IndexController($service);
    }
}
