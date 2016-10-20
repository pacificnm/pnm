<?php
namespace Application\Controller\Plugin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\Plugin\SetActiveSubMenu;
class SetActiveSubMenuFactory
{
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();

        $config = $realServiceLocator->get('Config');
        
        $phpRenderer = $realServiceLocator->get('Zend\View\Renderer\PhpRenderer');
        
        return new SetActiveSubMenu($config, $phpRenderer);
    }
}

?>