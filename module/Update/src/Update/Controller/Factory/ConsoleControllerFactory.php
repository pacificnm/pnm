<?php
namespace Update\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Update\Controller\ConsoleController;

class ConsoleControllerFactory implements FactoryInterface
{
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $installService = $realServiceLocator->get('Install\Service\InstallServiceInterface');
        
        $resourceService = $realServiceLocator->get('AclResource\Service\ResourceServiceInterface');
        
        $roleService = $realServiceLocator->get('AclRole\Service\RoleServiceInterface');
        
        $aclService = $realServiceLocator->get('Acl\Service\AclServiceInterface');
        
        $memcached = $realServiceLocator->get('memcached');
        
        $config = $realServiceLocator->get('Config');
        
        return new ConsoleController($installService, $resourceService, $roleService, $aclService, $memcached, $config);
    }
}