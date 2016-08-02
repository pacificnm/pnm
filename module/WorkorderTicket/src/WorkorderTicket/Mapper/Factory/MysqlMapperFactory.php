<?php
namespace WorkorderTicket\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use WorkorderTicket\Mapper\MysqlMapper;
use WorkorderTicket\Hydrator\WorkorderTicketHydrator;
use WorkorderTicket\Entity\WorkorderTicketEntity;

class MysqlMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderTicket\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new WorkorderTicketHydrator());
        
        $prototype = new WorkorderTicketEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

