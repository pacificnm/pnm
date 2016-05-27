<?php
namespace Auth\Adapter\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Adapter\AuthAdapter;

class AuthAdapterFactory implements FactoryInterface
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
        
        return new AuthAdapter($authService);
    }
}
