<?php
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
                )
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'PaymentOption\Controller\Index' => 'PaymentOption\Controller\Factory\IndexControllerFactory',
            'PaymentOption\Controller\Create' => 'PaymentOption\Controller\Factory\CreateControllerFactory',
            'PaymentOption\Controller\Update' => 'PaymentOption\Controller\Factory\UpdateControllerFactory',
            'PaymentOption\Controller\View' => 'PaymentOption\Controller\Factory\ViewControllerFactory',
            'PaymentOption\Controller\Delete' => 'PaymentOption\Controller\Factory\DeleteControllerFactoryF'
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
    )
);