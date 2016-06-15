<?php
namespace User\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Form\UserForm;

class UserFormFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $locationService = $serviceLocator->get('Location\Service\LocationServiceInterface');
        
        return new UserForm($locationService);
    }
}