<?php
namespace WorkorderPart\View\Helper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderPart\View\Helper\GetWorkorderParts;

class GetWorkorderPartsFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $partService = $realServiceLocator->get('WorkorderPart\Service\PartServiceInterface');
        
        return new GetWorkorderParts($partService);
    }
}
