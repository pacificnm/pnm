<?php
namespace Account\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Account\Form\AccountForm;

class AccountFormFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $typeService = $serviceLocator->get('AccountType\Service\TypeServiceInterface');
        
        return new AccountForm($typeService);
    }
}