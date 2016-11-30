<?php
namespace PayrollDeduction\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeduction\Controller\ViewController;

class ViewControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \PayrollDeduction\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('PayrollDeduction\Service\PayrollDeductionServiceInterface');
        
        return new ViewController($service);
    }
}

