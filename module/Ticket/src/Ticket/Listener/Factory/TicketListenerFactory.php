<?php
namespace Ticket\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Ticket\Listener\TicketListener;

class TicketListenerFactory
{

    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        return new TicketListener();
    }
}