<?php
namespace Panorama\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\Controller\UserController;
class UserControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Panorama\Controller\UserController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $mspService = $realServiceLocator->get('Panorama\Service\MspServiceInterface');
        
        $userService = $realServiceLocator->get('Panorama\Service\UserServiceInterface');
        
        return new UserController($mspService, $userService);
    }
}