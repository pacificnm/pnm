<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
        // this is for primary adapter which is using the profiler
        'driver' => 'Pdo',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
        
        // read and write adapters used in all factories
        'adapters' => array(
            'db1' => array(
                'driver' => 'Pdo',
                'driver_options' => array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                )
            ),
            'db2' => array(
                'driver' => 'Pdo',
                'driver_options' => array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                )
            )
        )
    ),
    
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($sm) {
                $config = $sm->get('config');
                $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter($config['db']);
                $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler());
                $adapter->injectProfilingStatementPrototype();
                return $adapter;
            }
        ),
        // to allow other adapter to be called by
        // $sm->get('db1') or $sm->get('db2') based on the adapters config.
        'abstract_factories' => array(
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory'
        ),
        // identity
        'aliases' => array(
            'Zend\Authentication\AuthenticationService' => 'my_auth_service',
            
            // remove for production in order to use read/write db this aliase uses the profiler
            'db1' => 'Zend\Db\Adapter\Adapter',
            'db2' => 'Zend\Db\Adapter\Adapter',
        ),
        
        'invokables' => array(
            'my_auth_service' => 'Zend\Authentication\AuthenticationService'
        )
    )
);
