<?php
namespace Client\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Client\Controller\CreateController;
use Client\Form\ClientForm;
use Location\Form\LocationForm;
use Phone\Form\PhoneForm;

class CreateControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $userService = $realServiceLocator->get('User\Service\UserServiceInterface');
        
        $locationService = $realServiceLocator->get('Location\Service\LocationServiceInterface');
        
        $phoneService = $realServiceLocator->get('Phone\Service\PhoneServiceInterface');
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        $clientAccountService = $realServiceLocator->get('ClientAccount\Service\AccountServiceInterface');
        
        $clientForm = new ClientForm();
        
        $locationForm = $realServiceLocator->get('Location\Form\LocationForm');
        
        $phoneForm = new PhoneForm();
        
        $userForm =  $realServiceLocator->get('User\Form\UserForm');
        
        return new CreateController($clientService, $userService, $locationService, $phoneService, $accountService, $clientAccountService, $clientForm, $locationForm, $phoneForm, $userForm);
    }
}