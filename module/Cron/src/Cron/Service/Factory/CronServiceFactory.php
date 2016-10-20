<?php
namespace Cron\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Cron\Service\CronService;

class CronServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Cron\Service\CronService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Cron\Mapper\MysqlMapperInterface');
        
        return new CronService($mapper);
    }
}