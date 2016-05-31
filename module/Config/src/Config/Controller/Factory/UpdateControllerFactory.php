<?php
namespace Config\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Config\Controller\UpdateController;
use Config\Form\ConfigForm;

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
        
        $configService = $realServiceLocator->get('Config\Service\ConfigServiceInterface');
        
        $configForm = new ConfigForm();
        
        return new UpdateController($configService, $configForm);
    }
}