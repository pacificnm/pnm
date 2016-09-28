<?php
namespace Client\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Client\Controller\UpdateController;
use Client\Form\ClientForm;
use Phone\Form\PhoneForm;

class UpdateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Client\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $locationService = $realServiceLocator->get('Location\Service\LocationServiceInterface');
        
        $phoneService = $realServiceLocator->get('Phone\Service\PhoneServiceInterface');
        
        $clientForm = new ClientForm();
        
        $locationForm = $realServiceLocator->get('Location\Form\LocationForm');
        
        $phoneForm = new PhoneForm();
        
        return new UpdateController($clientService, $locationService, $phoneService, $clientForm, $locationForm, $phoneForm);
    }
}