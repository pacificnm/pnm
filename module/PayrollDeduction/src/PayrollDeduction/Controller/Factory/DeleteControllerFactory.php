<?php
namespace PayrollDeduction\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeduction\Controller\DeleteController;

class DeleteControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PayrollDeduction\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('PayrollDeduction\Service\PayrollDeductionServiceInterface');
        
        return new DeleteController($service);
    }
}

