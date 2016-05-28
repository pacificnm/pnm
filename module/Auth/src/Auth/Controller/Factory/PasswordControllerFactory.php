<?php
namespace Auth\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\PasswordController;
use Auth\Form\PasswordForm;

class PasswordControllerFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $authService = $realServiceLocator->get('Auth\Service\AuthServiceInterface');
        
        $passwordForm = new PasswordForm();
        
        return new PasswordController($authService, $passwordForm);
    }
}
