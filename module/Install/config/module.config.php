<?php
return array(
    'module' => array(
        'Install' => array(
            'name' => 'Install',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Install\Controller\Index' => 'Install\Controller\Factory\IndexControllerFactory',
            'Install\Controller\Config' => 'Install\Controller\Factory\ConfigControllerFactory',
            'Install\Controller\Admin' => 'Install\Controller\Factory\AdminControllerfactory',
            'Install\Controller\Database' => 'Install\Controller\Factory\DatabaseControllerFactory',
            'Install\Controller\Complete' => 'Install\Controller\Factory\CompleteControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Install\Mapper\InstallMapperInterface' => 'Install\Mapper\Factory\InstallMapperFactory',
            'Install\Service\InstallServiceInterface' => 'Install\Service\Factory\InstallServiceFactory',
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'install-index' => array(
                'title' => 'Install',
                'type' => 'literal',
                'options' => array(
                    'route' => '/install',
                    'defaults' => array(
                        'controller' => 'Install\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'install-database' => array(
                'title' => 'Install',
                'type' => 'literal',
                'options' => array(
                    'route' => '/install/database',
                    'defaults' => array(
                        'controller' => 'Install\Controller\Database',
                        'action' => 'index'
                    )
                )
            ),
            'install-config' => array(
                'title' => 'Install',
                'type' => 'literal',
                'options' => array(
                    'route' => '/install/config',
                    'defaults' => array(
                        'controller' => 'Install\Controller\Config',
                        'action' => 'index'
                    )
                )
            ),
            'install-admin' => array(
                'title' => 'Install',
                'type' => 'literal',
                'options' => array(
                    'route' => '/install/admin',
                    'defaults' => array(
                        'controller' => 'Install\Controller\Admin',
                        'action' => 'index'
                    )
                )
            ),
            'install-complete' => array(
                'title' => 'Install',
                'type' => 'literal',
                'options' => array(
                    'route' => '/install/complete',
                    'defaults' => array(
                        'controller' => 'Install\Controller\Complete',
                        'action' => 'index'
                    )
                )
            ),
        ),
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);