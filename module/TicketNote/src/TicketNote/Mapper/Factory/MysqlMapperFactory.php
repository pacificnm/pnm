<?php
namespace TicketNote\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use TicketNote\Mapper\MysqlMapper;
use TicketNote\Hydrator\NoteHydrator;
use TicketNote\Entity\NoteEntity;

class MysqlMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \TicketNote\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new NoteHydrator());
        
        $prototype = new NoteEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

