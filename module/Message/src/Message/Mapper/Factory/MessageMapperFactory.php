<?php
namespace Message\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Message\Mapper\MessageMapper;
use Message\Hydrator\MessageHydrator;
use Message\Entity\MessageEntity;

class MessageMapperFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new MessageHydrator());
        
        $prototype = new MessageEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new MessageMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}