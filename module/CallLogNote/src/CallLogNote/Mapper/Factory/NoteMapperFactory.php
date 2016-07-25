<?php
namespace CallLogNote\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use CallLogNote\Mapper\NoteMapper;
use CallLogNote\Entity\NoteEntity;
use CallLogNote\Hydrator\NoteHydrator;


class NoteMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \CallLogNote\Mapper\NoteMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new NoteHydrator());
        
        $prototype = new NoteEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new NoteMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

