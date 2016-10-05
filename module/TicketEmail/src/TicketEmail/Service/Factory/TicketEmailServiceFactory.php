<?php
namespace TicketEmail\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use TicketEmail\Service\TicketEmailService;

class TicketEmailServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \TicketEmail\Service\TicketEmailService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('TicketEmail\Mapper\TicketEmailMapperInterface');
        
        $emailService = $serviceLocator->get('Email\Service\EmailServiceInterface');
        
        $clientService = $serviceLocator->get('Client\Service\ClientServiceInterface');
        
        $userService = $serviceLocator->get('User\Service\UserServiceInterface');
        
        $configService = $serviceLocator->get('Config\Service\ConfigServiceInterface');
        
        $renderer = $serviceLocator->get('Zend\View\Renderer\RendererInterface');
        
        return new TicketEmailService($mapper, $emailService, $clientService, $userService, $configService, $renderer);
    }
}