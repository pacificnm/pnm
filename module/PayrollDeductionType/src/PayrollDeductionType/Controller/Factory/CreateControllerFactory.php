<?php
namespace PayrollDeductionType\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeductionType\Controller\CreateController;
use PayrollDeductionType\Form\PayrollDeductionTypeForm;

class CreateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PayrollDeductionType\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface');
        
        $form = new PayrollDeductionTypeForm();
        
        return new CreateController($service, $form);
    }
}