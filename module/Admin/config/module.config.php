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
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'adminMenu' => 'Admin\Service\Factory\MenuServiceFactory'
            //'adminMenu' => 'Zend\Navigation\Service\DefaultNavigationFactory'
        )
    ),
    //
    
    // router
    'router' => array(
        'routes' => array(
            'admin-index' => array(
                'type' => 'literal',
                'title' => 'Admin Home',
                'pageTitle' => 'Admin',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'admin-index',
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
        'factories' => array(
            'AdminAsideMenu' => 'Admin\View\Helper\Factory\AdminAsideMenuFactory'
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
                'useRouteMatch' => true
            )
        )
    ),
    // menu
    'menu' => array(
        'default' => array(
            'admin' => array(
                array(
                    'label' => 'Home',
                    'icon' => 'fa fa-home',
                    'route' => 'admin-index',
                    'resource' => 'admin-index',
                    'order' => 0,
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