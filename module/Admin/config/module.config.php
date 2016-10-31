<?php
return array(
    'module' => array(
        'Admin' => array(
            'name' => 'Admin',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'admin-index'
                )
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Admin\Controller\Index' => 'Admin\Controller\Factory\IndexControllerFactory'
        )
    )
    ,
    
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
    ),
    
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
    ),
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
            )
        )
    ),
    // menu
    'menu' => array(
        'default' => array(
            array(
                'admin' => array(
                    'title' => 'Admin',
                    'icon' => 'fa fa-gears',
                    'route' => 'admin-index',
                    'submenu' => array(
                        array(
                            'admin-index' => array(
                                'title' => 'Home',
                                'icon' => 'fa fa-house',
                                'route' => 'admin-index'
                            )
                        )
                    )
                    
                )
            )
        )
    ),
    // acl
    'acl' => array(
        'default' => array(
            array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    )
);