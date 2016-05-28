<?php
namespace Auth\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\UpdateController;
use Auth\Form\AuthForm;

class UpdateControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $authService = $realServiceLocator->get('Auth\Service\AuthServiceInterface');
        
        $authForm = new AuthForm();
        
        return new UpdateController($authService, $authForm);
    }
}