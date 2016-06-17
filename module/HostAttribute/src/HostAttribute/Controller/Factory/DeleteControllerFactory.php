<?php
namespace HostAttribute\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttribute\Controller\DeleteController;

class DeleteControllerFactory implements FactoryInterface
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
        
        return new DeleteController($attributeService);
    }
}
