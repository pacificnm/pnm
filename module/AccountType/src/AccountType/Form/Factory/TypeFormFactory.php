<?php
namespace AccountType\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AccountType\Form\TypeForm;

class TypeFormFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $readAdapter = $serviceLocator->get('db1');
        
        return new TypeForm($readAdapter);
    }
}