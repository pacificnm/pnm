<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
return array(
    'module' => array(
        'PaymentOption' => array(
            'name' => 'PaymentOption',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'payment-option-index',
                    'payment-option-create',
                    'payment-option-view',
                    'payment-option-update',
                    'payment-option-delete'
                )
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'PaymentOption\Controller\Index' => 'PaymentOption\Controller\Factory\IndexControllerFactory',
            'PaymentOption\Controller\Create' => 'PaymentOption\Controller\Factory\CreateControllerFactory',
            'PaymentOption\Controller\Update' => 'PaymentOption\Controller\Factory\UpdateControllerFactory',
            'PaymentOption\Controller\View' => 'PaymentOption\Controller\Factory\ViewControllerFactory',
            'PaymentOption\Controller\Delete' => 'PaymentOption\Controller\Factory\DeleteControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'PaymentOption\Service\OptionServiceInterface' => 'PaymentOption\Service\Factory\OptionServiceFactory',
            'PaymentOption\Mapper\OptionMapperInterface' => 'PaymentOption\Mapper\Factory\OptionMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'payment-option-index' => array(
                'title' => 'Payment Options',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'payment-option-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/payment-options',
                    'defaults' => array(
                        'controller' => 'PaymentOption\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'payment-option-create' => array(
                'title' => 'Create Payment Options',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'payment-option-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/payment-options/create',
                    'defaults' => array(
                        'controller' => 'PaymentOption\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'payment-option-view' => array(
                'title' => 'View Payment Options',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'payment-option-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payment-options/view/[:paymentOptionId]',
                    'defaults' => array(
                        'controller' => 'PaymentOption\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
            'payment-option-update' => array(
                'title' => 'Edit Payment Options',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'payment-option-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payment-options/update/[:paymentOptionId]',
                    'defaults' => array(
                        'controller' => 'PaymentOption\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'payment-option-delete' => array(
                'title' => 'Edit Payment Options',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'payment-option-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payment-options/delete/[:paymentOptionId]',
                    'defaults' => array(
                        'controller' => 'PaymentOption\Controller\Delete',
                        'action' => 'index'
                    )
                )
            )
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
                'pages' => array(
                    array(
                        'label' => 'Payment Options',
                        'route' => 'payment-option-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'payment-option-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'Edit',
                                'route' => 'payment-option-update',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'Delete',
                                'route' => 'payment-option-delete',
                                'useRouteMatch' => true
                            )
                        )
                    )
                )
            )
        )
    ),
    // menu
    'menu' => array(
        'admin' => array(
            array(
                array(
                    'label' => 'Admin',
                    'icon' => 'fa fa-gears',
                    'route' => 'admin-index',
                    'submenu' => array(
                        array(
                            'label' => 'Payment Options',
                            'icon' => 'fa fa-dollar',
                            'route' => 'payment-option-index'
                        )
                    )
                )
            )
        ),
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