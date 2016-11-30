<?php
namespace PayrollDeductionType\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeductionType\Form\PayrollDeductionTypeForm;
use PayrollDeductionType\Controller\UpdateController;

class UpdateControllerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \PayrollDeductionType\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface');
        
        $form = new PayrollDeductionTypeForm();
        
        return new UpdateController($service, $form);
    }
}