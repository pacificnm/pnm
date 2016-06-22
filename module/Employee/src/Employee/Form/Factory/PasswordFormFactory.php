<?php
namespace Employee\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Employee\Form\PasswordForm;

class PasswordFormFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $authService = $serviceLocator->get('Auth\Service\AuthServiceInterface');
        
        
        
        return new PasswordForm($authService);
    }
}
