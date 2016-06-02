<?php
namespace Message\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Message\Service\MessageService;

class MessageServiceFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $mapper = $serviceLocator->get('Message\Mapper\MessageMapperInterface');
        
        return new MessageService($mapper);
    }
}