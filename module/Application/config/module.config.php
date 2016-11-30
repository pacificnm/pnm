<?php
return array(
    'module' => array(
        'Application' => array(
            'name' => 'Application',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    0 => 'home',
                    1 => 'keep-alive'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\\Mvc\\Router\\Http\\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\\Controller\\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'keep-alive' => array(
                'type' => 'Zend\\Mvc\\Router\\Http\\Literal',
                'options' => array(
                    'route' => '/keep-alive',
                    'defaults' => array(
                        'controller' => 'Application\\Controller\\KeepAliveController',
                        'action' => 'index'
                    )
                )
            ),
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            'application.rpc.ping' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ping',
                    'defaults' => array(
                        'controller' => 'Application\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping'
                    )
                )
            )
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            0 => 'Zend\\Cache\\Service\\StorageCacheAbstractServiceFactory',
            1 => 'Zend\\Log\\LoggerAbstractServiceFactory'
        ),
        'factories' => array(
            'translator' => 'Zend\\Mvc\\Service\\TranslatorServiceFactory',
            'navigation' => 'Zend\\Navigation\\Service\\DefaultNavigationFactory',
            'Application\\Service\\GitHubServiceInterface' => 'Application\\Service\\Factory\\GitHubServiceFactory',
            'Application\\Mapper\\GitHubMapperInterface' => 'Application\\Mapper\\Factory\\GitHubMapperFactory'
        )
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            0 => array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(),
        'factories' => array(
            'Application\\Controller\\IndexController' => 'Application\\Controller\\Factory\\IndexControllerFactory',
            'Application\\Controller\\BaseController' => 'Application\\Controller\\Factory\\BaseControllerFactory',
            'Application\\Controller\\KeepAliveController' => 'Application\\Controller\\Factory\\KeepAliveControllerFactory',
            'Application\\V1\\Rpc\\Ping\\Controller' => 'Application\\V1\\Rpc\\Ping\\PingControllerFactory'
        )
    ),
    'controller_plugins' => array(
        'factories' => array(
            'SetPageTitle' => 'Application\\Controller\\Plugin\\Factory\\SetPageTitleFactory',
            'SetHeadTitle' => 'Application\\Controller\\Plugin\\Factory\\SetHeadTitleFactory',
            'SetActiveMenu' => 'Application\Controller\Plugin\Factory\SetActiveMenuFactory',
            'SetActiveSubMenu' => 'Application\Controller\Plugin\Factory\SetActiveSubMenuFactory',
            'SetPageSubTitle' => 'Application\Controller\Plugin\Factory\SetPageSubTitleFactory',
            'Acl' => 'Application\\Controller\\Plugin\\Factory\\ApplicationAclFactory'
        ),
        'invokables' => array()
    ),
    'view_helpers' => array(
        'invokables' => array(
            'Paginator' => 'Application\\View\\Helper\\Paginator',
            'IntegrationAsideMenu' => 'Application\View\Helper\IntegrationAsideMenu'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => false,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'error/layout' => __DIR__ . '/../view/layout/error.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml'
        ),
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array()
        )
    ),
    'navigation' => array(
        'default' => array(
           
        )
    ),
    
    'acl' => array(
        'default' => array(
            'guest' => array(),
            'user' => array(
                0 => 'home',
                1 => 'keep-alive'
            ),
            'user-accountant' => array(),
            'user-manager' => array(),
            'employee' => array(),
            'accountant' => array(),
            'administrator' => array()
        ),
        'my_default' => array(
            'guest' => array(),
            'user' => array(
                0 => 'home',
                1 => 'keep-alive'
            ),
            'user-accountant' => array(),
            'user-manager' => array(),
            'employee' => array(),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    'zf-versioning' => array(
        'uri' => array(
            0 => 'application.rpc.ping'
        )
    ),
    'zf-rest' => array(),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Application\\V1\\Rpc\\Ping\\Controller' => 'Json'
        ),
        'accept_whitelist' => array(
            'Application\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.application.v1+json',
                1 => 'application/json',
                2 => 'application/*+json'
            )
        ),
        'content_type_whitelist' => array(
            'Application\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.application.v1+json',
                1 => 'application/json'
            )
        )
    ),
    'zf-hal' => array(
        'metadata_map' => array()
    ),
    'zf-rpc' => array(
        'Application\\V1\\Rpc\\Ping\\Controller' => array(
            'service_name' => 'ping',
            'http_methods' => array(
                0 => 'GET'
            ),
            'route_name' => 'application.rpc.ping'
        )
    )
);
