<?php
namespace AccountType\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AccountType\Controller\CreateController;
use AccountType\Form\TypeForm;

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
        
        $typeService = $realServiceLocator->get('AccountType\Service\TypeServiceInterface');
        
        $typeForm = $realServiceLocator->get('AccountType\Form\TypeForm');
        
        return new CreateController($typeService, $typeForm);
    }
}
