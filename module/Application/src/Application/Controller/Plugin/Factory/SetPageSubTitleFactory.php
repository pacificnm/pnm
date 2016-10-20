<?php
namespace Application\Controller\Plugin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\Plugin\SetPageSubTitle;
class SetPageSubTitleFactory
{
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        die('nigger');
        
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $config = $realServiceLocator->get('Config');
        
        $phpRenderer = $realServiceLocator->get('Zend\View\Renderer\PhpRenderer');
        
        return new SetPageSubTitle($config, $phpRenderer);
    }
}

?>