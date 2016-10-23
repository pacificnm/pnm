<?php
namespace Cron;

use Zend\Console\Adapter\AdapterInterface as Console;

class Module
{
    /**
     * System cron is runs this script every min. It checks cron table for any consol controllers to run.
     * 

     * @param Console $console
     * @return string[]|string[][]
     */
    public function getConsoleUsage(Console $console)
    {
        return array(
            'cron --run' => 'Checks for cron jobs and runs them. See Module.php for more information',
            'cron --list' => 'Lists active crons',
            'cron --runing' => 'List running cron jobs',
            'cron --kill --pid=[pid]' => 'Kills a running cron and sets it to disabled'
        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
