<?php
namespace HostAttributeMap\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttributeMap\Form\ScannerForm;

class ScannerFormFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $valueService = $serviceLocator->get('HostAttributeValue\Service\ValueServiceInterface');
        
        return new ScannerForm($valueService);
    }
}