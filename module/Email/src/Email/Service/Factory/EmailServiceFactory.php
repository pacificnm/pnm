<?php
namespace Email\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Email\Service\EmailService;
class EmailServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Email\Service\EmailService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Email\Mapper\EmailMapperInterface');
        
        $configService = $serviceLocator->get('Config\Service\ConfigServiceInterface');
        
        $config = $serviceLocator->get('config');
        
        return new EmailService($mapper, $configService, $config);
    }
}