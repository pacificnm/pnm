<?php
namespace Install\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Install\Controller\ConfigController;
use Install\Form\ConfigForm;


class ConfigControllerFactory implements FactoryInterface
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
        
        $configService = $realServiceLocator->get('Config\Service\ConfigServiceInterface');
        
        $configForm = new ConfigForm();
        
        return new ConfigController($configService, $configForm);
    }
}