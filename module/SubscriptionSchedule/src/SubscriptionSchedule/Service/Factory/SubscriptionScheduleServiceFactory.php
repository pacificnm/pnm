<?php
namespace SubscriptionSchedule\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionSchedule\Service\SubscriptionScheduleService;

class SubscriptionScheduleServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \SubscriptionSchedule\Service\SubscriptionScheduleService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('SubscriptionSchedule\Mapper\MysqlMapperInterface');
        
        return new SubscriptionScheduleService($mapper);
    }
}