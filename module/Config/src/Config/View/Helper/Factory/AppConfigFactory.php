<?php
namespace Config\View\Helper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Config\View\Helper\AppConfig;

class AppConfigFactory implements FactoryInterface
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
        
        return new AppConfig($configService);
    }
}
