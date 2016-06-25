<?php
namespace Application\Controller\Plugin\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\Plugin\ApplicationAcl;

class ApplicationAclFactory implements FactoryInterface
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
        
        $aclService = $realServiceLocator->get('Acl\Service\AclServiceInterface');
        
        $roleService = $realServiceLocator->get('AclRole\Service\RoleServiceInterface');
        
        $resourceService = $realServiceLocator->get('AclResource\Service\ResourceServiceInterface');
        
        $memcached = $realServiceLocator->get('memcached');
        
        return new ApplicationAcl($aclService, $roleService, $resourceService, $memcached);
    }
}