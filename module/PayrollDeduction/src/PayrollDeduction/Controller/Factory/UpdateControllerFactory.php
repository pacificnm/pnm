<?php
namespace PayrollDeduction\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeduction\Controller\UpdateController;

class UpdateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PayrollDeduction\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('PayrollDeduction\Service\PayrollDeductionServiceInterface');
        
        $form = $realServiceLocator->get('PayrollDeduction\Form\PayrollDeductionForm');
        
        return new UpdateController($service, $form);
    }
}

