<?php
namespace Employee\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Employee\View\Helper\EmployeeAsideMenu;

class EmployeeAsideMenuFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Employee\View\Helper\EmployeeAsideMenu
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
       
        
        return new EmployeeAsideMenu();
    }
}
