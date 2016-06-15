<?php
namespace User\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Controller\UpdateController;

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
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $userService = $realServiceLocator->get('User\Service\UserServiceInterface');
        
        $userForm = $realServiceLocator->get('User\Form\UserForm');
        
        return new UpdateController($clientService, $userService, $userForm);
    }
}