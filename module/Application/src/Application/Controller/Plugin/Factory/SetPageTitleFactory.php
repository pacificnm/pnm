<?php
namespace Application\Controller\Plugin\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\Plugin\SetPageTitle;

class SetPageTitleFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $config = $realServiceLocator->get('Config');
        
        $phpRenderer = $realServiceLocator->get('Zend\View\Renderer\PhpRenderer');
        
        return new SetPageTitle($config, $phpRenderer);
    }
}