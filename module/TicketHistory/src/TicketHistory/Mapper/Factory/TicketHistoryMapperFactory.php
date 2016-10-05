<?php
namespace TicketHistory\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use TicketHistory\Mapper\TicketHistoryMapper;
use TicketHistory\Hydrator\TicketHistoryHydrator;
use TicketHistory\Entity\TicketHistoryEntity;

class TicketHistoryMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \TicketHistory\Mapper\TicketHistoryMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new TicketHistoryHydrator());
        
        $prototype = new TicketHistoryEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new TicketHistoryMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}