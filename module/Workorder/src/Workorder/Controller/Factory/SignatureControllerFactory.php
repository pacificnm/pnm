<?php
namespace Workorder\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Workorder\Controller\SignatureController;
use Workorder\Form\SignatureForm;

class SignatureControllerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Workorder\Controller\SignatureController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $signatureForm = new SignatureForm();
        
        return new SignatureController($clientService, $workorderService, $signatureForm);
    }
}

