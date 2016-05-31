<?php
namespace Password\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Password\Controller\CreateController;
use Password\Form\PasswordForm;

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
        
        $passwordService = $realServiceLocator->get('Password\Service\PasswordServiceInterface');
        
        $passwordForm = new PasswordForm();
        
        $config = $realServiceLocator->get('config');
        
        return new CreateController($clientService, $passwordService, $passwordForm, $config);
    }
}