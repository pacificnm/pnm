<?php
namespace TicketHistory\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use TicketHistory\Service\TIcketHistoryService;
class TicketHistoryServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \TicketHistory\Service\TIcketHistoryService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('TicketHistory\Mapper\TicketHistoryMapperInterface');
        
        $historyService = $serviceLocator->get('History\Service\HistoryServiceInterface');
        
        return new TIcketHistoryService($mapper, $historyService);
    }
}