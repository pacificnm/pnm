<?php
namespace AclRole\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AclRole\Service\RoleService;

class RoleServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('AclRole\Mapper\RoleMapperInterface');
        
        return new RoleService($mapper);
    }
}