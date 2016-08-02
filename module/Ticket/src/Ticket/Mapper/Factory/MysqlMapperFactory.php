<?php
namespace Ticket\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Mapper\MysqlMapper;
use Ticket\Hydrator\TicketHydrator;
use Ticket\Entity\TicketEntity;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

class MysqlMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Ticket\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new TicketHydrator());
        
        $prototype = new TicketEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

