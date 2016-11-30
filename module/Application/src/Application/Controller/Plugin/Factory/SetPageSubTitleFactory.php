<?php
namespace Application\Controller\Plugin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\Plugin\SetPageSubTitle;

class SetPageSubTitleFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Application\Controller\Plugin\SetPageSubTitle
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $config = $realServiceLocator->get('Config');
        
        $phpRenderer = $realServiceLocator->get('Zend\View\Renderer\PhpRenderer');
        
        return new SetPageSubTitle($config, $phpRenderer);
    }
}