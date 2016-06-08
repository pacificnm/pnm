<?php
namespace Application\Controller\Plugin\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\Plugin\SetHeadTitle;

class SetHeadTitleFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $phpRenderer = $realServiceLocator->get('Zend\View\Renderer\PhpRenderer');
        
        return new SetHeadTitle($phpRenderer);
    }
}