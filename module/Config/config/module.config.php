<?php
return array(
    'module' => array(
        'Config' => array(
            'name' => 'Config',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'config-index',
                    'config-update'
                )
            )
        ),
    ),
    
    'controllers' => array(
        'factories' => array(
            'Config\Controller\Index' => 'Config\Controller\Factory\IndexControllerFactory',
            'Config\Controller\Update' => 'Config\Controller\Factory\UpdateControllerFactory'
        )
    )
    ,
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Config\Mapper\ConfigMapperInterface' => 'Config\Mapper\Factory\ConfigMapperFactory',
            'Config\Service\ConfigServiceInterface' => 'Config\Service\Factory\ConfigServiceFactory',
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'config-index' => array(
                'title' => 'Config',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/config',
                    'defaults' => array(
                        'controller' => 'Config\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'config-update' => array(
                'title' => 'Edit Config',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/config/update',
                    'defaults' => array(
                        'controller' => 'Config\Controller\Update',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'AppConfig' => 'Config\View\Helper\Factory\AppConfigFactory'
        ),
        'invokables' => array(
            
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);