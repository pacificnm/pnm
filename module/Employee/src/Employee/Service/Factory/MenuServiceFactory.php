<?php
namespace Employee\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Employee\Service\MenuService;

class MenuServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Zend\Navigation\Navigation
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $navigation = new MenuService();
        
        return $navigation->createService($serviceLocator);
    }
}
