<?php
return array(
    'module' => array(
        'Admin' => array(
            'name' => 'Admin',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'admin-index'
                )
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Admin\Controller\Index' => 'Admin\Controller\Factory\IndexControllerFactory',
        )

        
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array()
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'admin-index' => array(
                'type' => 'literal',
                'title' => 'Admin Home',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'index'
                    )
                )
            )
        )
    )
    ,
    
    // view helpers
    'view_helpers' => array(
        'invokables' => array(
            'AdminAsideMenu' => 'Admin\View\Helper\AdminAsideMenu'
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);