<?php
namespace HostAttribute\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttribute\Controller\CreateController;
use HostAttribute\Form\AttributeForm;

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
        
        $attributeService = $realServiceLocator->get('HostAttribute\Service\AttributeServiceInterface');
        
        $attributeForm = new AttributeForm();
        
        return new CreateController($attributeService, $attributeForm);
    }
}