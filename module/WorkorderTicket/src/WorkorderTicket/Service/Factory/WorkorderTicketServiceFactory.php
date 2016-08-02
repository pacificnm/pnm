<?php
namespace WorkorderTicket\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderTicket\Service\WorkorderTicketService;

class WorkorderTicketServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderTicket\Service\WorkorderTicketService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        
        $mapper = $serviceLocator->get('WorkorderTicket\Mapper\MysqlMapperInterface');
        
        return new WorkorderTicketService($mapper);
    }
}

