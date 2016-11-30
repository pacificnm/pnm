<?php
namespace Payroll\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Payroll\Controller\IndexController;

class IndexControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Payroll\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Payroll\Service\PayrollServiceInterface');
        
        return new IndexController($service);
    }
}