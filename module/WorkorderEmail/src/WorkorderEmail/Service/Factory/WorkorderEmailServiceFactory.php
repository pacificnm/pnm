<?php
namespace WorkorderEmail\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderEmail\Service\WorkorderEmailService;
class WorkorderEmailServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderEmail\Service\WorkorderEmailService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('WorkorderEmail\Mapper\MysqlMapperInterface');
        
        $emailService = $serviceLocator->get('Email\Service\EmailServiceInterface');
        
        return new WorkorderEmailService($mapper, $emailService);
    }
}