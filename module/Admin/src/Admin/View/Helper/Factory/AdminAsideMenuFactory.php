<?php
namespace Admin\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Admin\View\Helper\AdminAsideMenu;

class AdminAsideMenuFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Admin\View\Helper\AdminAsideMenu
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $config = $realServiceLocator->get('config');
        
        return new AdminAsideMenu($config['menu']['default']['admin']);
    }
}