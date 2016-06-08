<?php
namespace Application\Controller\Plugin\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\Plugin\Acl;

class AclFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $config = $realServiceLocator->get('Config');
        
        return new Acl($config);
    }
}