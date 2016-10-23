<?php
namespace Cron\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Cron\Controller\ConsoleController;

class ConsoleControllerFactory
{
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {        
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $cronService = $realServiceLocator->get('Cron\Service\CronServiceInterface');
        
        $console = $realServiceLocator->get('console');
        
        return new ConsoleController($cronService, $console);
    }
}

?>