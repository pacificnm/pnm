<?php
namespace TaskNote\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use TaskNote\Mapper\NoteMapper;
use TaskNote\Hydrator\NoteHydrator;
use TaskNote\Entity\NoteEntity;

class NoteMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new NoteHydrator());
        
        $prototype = new NoteEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new NoteMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}