<?php
namespace Client\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Client\View\Helper\ClientAsideMenu;

class ClientAsideMenuFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Client\View\Helper\ClientAsideMenu
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new ClientAsideMenu();
    }
}