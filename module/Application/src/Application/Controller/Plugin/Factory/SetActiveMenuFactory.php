<?php
namespace Application\Controller\Plugin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\Plugin\SetActiveMenu;

class SetActiveMenuFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Application\Controller\Plugin\SetActiveMenu
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $config = $realServiceLocator->get('Config');
        
        $phpRenderer = $realServiceLocator->get('Zend\View\Renderer\PhpRenderer');
        
        return new SetActiveMenu($config, $phpRenderer);
    }
}