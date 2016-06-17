<?php
namespace HostType\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostType\Controller\CreateController;
use HostType\Form\TypeForm;

class CreateControllerFactory implements FactoryInterface
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
        
        $typeService = $realServiceLocator->get('HostType\Service\TypeServiceInterface');
        
        $typeForm = new TypeForm();
        
        return new CreateController($typeService, $typeForm);
    }
}
