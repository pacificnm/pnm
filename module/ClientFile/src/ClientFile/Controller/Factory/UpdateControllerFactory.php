<?php
namespace ClientFile\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;

class UpdateControllerFactory
{
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
    }
}

?>