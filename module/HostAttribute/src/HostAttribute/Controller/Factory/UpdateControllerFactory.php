<?php
namespace HostAttribute\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttribute\Controller\UpdateController;
use HostAttribute\Form\AttributeForm;

class UpdateControllerFactory implements FactoryInterface
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
        
        $attributeService = $realServiceLocator->get('HostAttribute\Service\AttributeServiceInterface');
        
        $attributeForm = new AttributeForm();
        
        return new UpdateController($attributeService, $attributeForm);
    }
}