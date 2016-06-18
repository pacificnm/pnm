<?php
namespace HostAttributeValue\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttributeValue\Controller\UpdateController;
use HostAttributeValue\Form\ValueForm;

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
        
        $attributeService = $realServiceLocator->get('HostAttribute\Service\AttributeServiceInterface');
        
        $valueService = $realServiceLocator->get('HostAttributeValue\Service\ValueServiceInterface');
        
        $valueForm = new ValueForm();
        
        return new UpdateController($attributeService, $valueService, $valueForm);
    }
}