<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
return array(
    'module' => array(
        'Config' => array(
            'name' => 'Config',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'config-index',
                    'config-update'
                )
            )
        )
    ),
    
    'controllers' => array(
        'factories' => array(
            'Config\Controller\Index' => 'Config\Controller\Factory\IndexControllerFactory',
            'Config\Controller\Update' => 'Config\Controller\Factory\UpdateControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Config\Mapper\ConfigMapperInterface' => 'Config\Mapper\Factory\ConfigMapperFactory',
            'Config\Service\ConfigServiceInterface' => 'Config\Service\Factory\ConfigServiceFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'config-index' => array(
                'title' => 'Config',
                'type' => 'literal',
                'pageTitle' => 'Config',
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
        'invokables' => array()
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    // menu
    'menu' => array(
        'default' => array(
            'admin' => array(
                array(
                    'label' => 'Config',
                    'icon' => 'fa fa-cog',
                    'route' => 'config-index',
                    'resource' => 'config-index',
                    'order' => 2
                )
            )
        )
    ),
    
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Config',
                        'route' => 'config-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Edit Config',
                                'route' => 'config-update',
                                'useRouteMatch' => true
                            )
                        )
                    )
                )
            )
        )
    )
)
;