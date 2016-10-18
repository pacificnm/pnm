<?php
namespace CallLogEmail\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use CallLogEmail\Service\CallLogEmailService;

class CallLogEmailServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \CallLogEmail\Service\CallLogEmailService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('CallLogEmail\Mapper\MysqlMapperInterface');
        
        $emailService = $serviceLocator->get('Email\Service\EmailServiceInterface');
        
        $configService = $serviceLocator->get('Config\Service\ConfigServiceInterface');
        
        $renderer = $serviceLocator->get('Zend\View\Renderer\RendererInterface');
        
        return new CallLogEmailService($mapper, $emailService, $configService, $renderer);
        
    }
}