<?php
namespace HostType\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostType\Controller\UpdateController;
use HostType\Form\TypeForm;

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
        
        $typeService = $realServiceLocator->get('HostType\Service\TypeServiceInterface');
        
        $typeForm = new TypeForm();
        
        return new UpdateController($typeService, $typeForm);
    }
}
