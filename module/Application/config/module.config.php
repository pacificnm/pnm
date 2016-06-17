<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

return array(
    
    'Application' => array(
        'name' => 'Application',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(
                'home'
            ),
            'employee' => array(),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
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
            )
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory'
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
        )
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => Controller\IndexController::class
        ),
        'factories' => array(
            'Application\Controller\BaseController' => 'Application\Controller\Factory\BaseControllerFactory'
        )
    ),
    
    'controller_plugins' => array(
        'factories' => array(
            'SetPageTitle' => 'Application\Controller\Plugin\Factory\SetPageTitleFactory',
            'SetHeadTitle' => 'Application\Controller\Plugin\Factory\SetHeadTitleFactory',
            'Acl' => 'Application\Controller\Plugin\Factory\ApplicationAclFactory'
        ),
        'invokables' => array()
    ),
    
    // view helpers
    'view_helpers' => array(
        'invokables' => array(
            'Paginator' => 'Application\View\Helper\Paginator'
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
            __DIR__ . '/../view'
        )
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array()
        )
    ),
    
    // navigation for breadcrumb
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
                'pages' => array(
                    array(
                        'label' => 'My Profile',
                        'route' => 'employee-profile',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Favorite Clients',
                                'route' => 'client-favorite-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'client-favorite-delete',
                                        'useRouteMatch' => true
                                    )
                                )
                            ),
                            array(
                                'label' => 'Edit',
                                'route' => 'employee-profile-update',
                                'useRouteMatch' => true,
                            ),
                        )
                    ),
                    
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
                            ),
                            array(
                                'label' => 'Payment Options',
                                'route' => 'payment-option-index',
                                'useRouteMatch' => true,
                                'pages' => array()
                            ),
                            array(
                                'label' => 'Invoice Options',
                                'route' => 'invoice-option-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'invoice-option-update',
                                        'useRouteMatch' => true
                                    )
                                )
                            ),
                            array(
                                'label' => 'Labor Rates',
                                'route' => 'labor-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'View Labor Rate',
                                        'route' => 'labor-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Edit Labor Rate',
                                                'route' => 'labor-update',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Delete Labor Rate',
                                                'route' => 'labor-delete',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Create Labor Rate',
                                        'route' => 'labor-create',
                                        'useRouteMatch' => true
                                    )
                                )
                            ),
                            array(
                                'label' => 'Host Types',
                                'route' => 'host-type-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'View',
                                        'route' => 'host-type-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Edit',
                                                'route' => 'host-type-update',
                                            ),
                                            array(
                                                'label' => 'Delete',
                                                'route' => 'host-type-delete',
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Create Host Type',
                                        'route' => 'host-type-create',
                                        'useRouteMatch' => true,
                                    )
                                )
                            ),
                            array(
                                'label' => 'Employee',
                                'route' => 'employee-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'View Employee',
                                        'route' => 'employee-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Edit Employee',
                                                'route' => 'employee-update',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Delete Employee',
                                                'route' => 'employee-delete',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Create Employee',
                                        'route' => 'employee-create',
                                        'useRouteMatch' => true
                                    )
                                )
                            ),
                            array(
                                'label' => 'Auth',
                                'route' => 'auth-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Create',
                                        'route' => 'auth-create',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'View',
                                        'route' => 'auth-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Update',
                                                'route' => 'auth-update',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Delete',
                                                'route' => 'auth-delete',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Reset Password',
                                                'route' => 'auth-password',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    )
                                )
                            )
                        )
                    ),
                    array(
                        'label' => 'Clients',
                        'route' => 'client-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'View Client',
                                'route' => 'client-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit Client',
                                        'route' => 'client-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Location',
                                        'route' => 'location-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Edit Location',
                                                'route' => 'location-update',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'New Location',
                                        'route' => 'location-create',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Hosts',
                                        'route' => 'host-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'View Host',
                                                'route' => 'host-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    array(
                                                        'label' => 'Edit Host',
                                                        'route' => 'host-update',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Host',
                                                        'route' => 'host-delete',
                                                        'useRouteMatch' => true
                                                    )
                                                )
                                            ),
                                            array(
                                                'label' => 'Create Host',
                                                'route' => 'host-create',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Invoices',
                                        'route' => 'invoice-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Create Invoice',
                                                'route' => 'invoice-create',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'View Invoice',
                                                'route' => 'invoice-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    array(
                                                        'label' => 'Edit Invoice',
                                                        'route' => 'invoice-update',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Invoice',
                                                        'route' => 'invoice-delete',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Print Invoice',
                                                        'route' => 'invoice-print',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Payment',
                                                        'route' => 'invoice-payemnt-delete',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Invoice Item',
                                                        'route' => 'invoice-item-delete',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Add Work Order',
                                                        'route' => 'invoice-workorder',
                                                        'useRouteMatch' => true
                                                    )
                                                )
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Network Settings',
                                        'route' => 'network-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'View Network Setting',
                                                'route' => 'network-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    array(
                                                        'label' => 'Edit Network Setting',
                                                        'route' => 'network-update',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Network Setting',
                                                        'route' => 'network-delete',
                                                        'useRouteMatch' => true
                                                    )
                                                )
                                            ),
                                            array(
                                                'label' => 'Create Network Setting',
                                                'route' => 'network-create',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Passwords',
                                        'route' => 'password-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'View Password',
                                                'route' => 'password-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    array(
                                                        'label' => 'Edit Password',
                                                        'route' => 'password-update',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Password',
                                                        'route' => 'password-delete',
                                                        'useRouteMatch' => true
                                                    )
                                                )
                                            ),
                                            array(
                                                'label' => 'Create Password',
                                                'route' => 'password-create',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Tasks',
                                        'route' => 'task-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'View Task',
                                                'route' => 'task-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    array(
                                                        'label' => 'Edit Task',
                                                        'route' => 'task-update',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Task',
                                                        'route' => 'task-delete',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Edit Note',
                                                        'route' => 'task-note-update',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Note',
                                                        'route' => 'task-note-delete',
                                                        'useRouteMatch' => true
                                                    )
                                                )
                                            ),
                                            array(
                                                'label' => 'Create Task',
                                                'route' => 'task-create',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Users',
                                        'route' => 'user-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Create User',
                                                'route' => 'user-create',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'View User',
                                                'route' => 'user-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    array(
                                                        'label' => 'Edit User',
                                                        'route' => 'user-update',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete User',
                                                        'route' => 'user-delete',
                                                        'useRouteMatch' => true
                                                    )
                                                )
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Work Orders',
                                        'route' => 'workorder-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Create Work Order',
                                                'route' => 'workorder-create',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'View Work Order',
                                                'route' => 'workorder-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    array(
                                                        'label' => 'Edit Work Order',
                                                        'route' => 'workorder-update',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Work Order',
                                                        'route' => 'workorder-delete',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Print Work Order',
                                                        'route' => 'workorder-print',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Time',
                                                        'route' => 'workorder-time-delete',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Part',
                                                        'route' => 'workorder-part-delete',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Edit Note',
                                                        'route' => 'workorder-note-update',
                                                        'useRouteMatch' => true
                                                    ),
                                                    array(
                                                        'label' => 'Delete Note',
                                                        'route' => 'workorder-note-delete',
                                                        'useRouteMatch' => true
                                                    )
                                                )
                                            )
                                        )
                                    )
                                )
                            ),
                            array(
                                'label' => 'New Client',
                                'route' => 'client-create',
                                'useRouteMatch' => true
                            )
                        )
                    )
                )
            )
        )
    )
);
