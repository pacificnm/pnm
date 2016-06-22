<?php
namespace Account\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Account\Controller\CreateController;

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
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        $accountForm = $realServiceLocator->get('Account\Form\AccountForm');
        
       return new CreateController($accountService, $accountForm);
    }
}