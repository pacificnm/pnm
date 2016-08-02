<?php
namespace TicketNote\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use TicketNote\Service\NoteService;

class NoteServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \TicketNote\Service\NoteService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('TicketNote\Mapper\MysqlMapperInterface');
        
        return new NoteService($mapper);
    }
}

