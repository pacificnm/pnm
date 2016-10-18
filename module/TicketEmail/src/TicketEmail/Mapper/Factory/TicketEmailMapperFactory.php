<?php
namespace TicketEmail\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use TicketEmail\Mapper\TicketEmailMapper;
use TicketEmail\Hydrator\TicketEmailHydrator;
use TicketEmail\Entity\TicketEmailEntity;

class TicketEmailMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \TicketEmail\Mapper\TicketEmailMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new TicketEmailHydrator());
        
        $prototype = new TicketEmailEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new TicketEmailMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}