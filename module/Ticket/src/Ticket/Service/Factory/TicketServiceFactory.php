<?php
namespace Ticket\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Service\TicketService;

class TicketServiceFactory
{
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Ticket\Mapper\MysqlMapperInterface');
        
        return new TicketService($mapper);
    }
}

