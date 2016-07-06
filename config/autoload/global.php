<?php
return array(
    'db' => array(
        'driver' => 'Pdo',
        'driver_options' => array(
            1002 => 'SET NAMES \'UTF8\'',
        ),
        'adapters' => array(
            'db1' => array(
                'driver' => 'Pdo',
                'driver_options' => array(
                    1002 => 'SET NAMES \'UTF8\'',
                ),
            ),
            'db2' => array(
                'driver' => 'Pdo',
                'driver_options' => array(
                    1002 => 'SET NAMES \'UTF8\'',
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(),
        'abstract_factories' => array(
            0 => 'Zend\\Db\\Adapter\\AdapterAbstractServiceFactory',
            1 => 'Zend\\Cache\\Service\\StorageCacheAbstractServiceFactory',
        ),
        'aliases' => array(
            'Zend\\Authentication\\AuthenticationService' => 'my_auth_service',
        ),
        'invokables' => array(
            'my_auth_service' => 'Zend\\Authentication\\AuthenticationService',
        ),
    ),
    'router' => array(
        'routes' => array(
            'oauth' => array(
                'options' => array(
                    'spec' => '%oauth%',
                    'regex' => '(?P<oauth>(/oauth))',
                ),
                'type' => 'regex',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(
            'map' => array(
                'Task\\V1' => 'oauthadapter',
            ),
        ),
    ),
);
