<?php
return array(
    'module' => array(
        'WorkorderOption' => array(
            'name' => 'WorkorderOption',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'workorder-option-index',
                    'workorder-option-update'
                )
            )
        )
    ),
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderOption\Controller\IndexController' => 'WorkorderOption\Controller\Factory\IndexControllerFactory',
            'WorkorderOption\Controller\UpdateController' => 'WorkorderOption\Controller\Factory\UpdateControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderOption\Service\OptionServiceInterface' => 'WorkorderOption\Service\Factory\OptionServiceFactory',
            'WorkorderOption\Mapper\OptionMapperInterface' => 'WorkorderOption\Mapper\Factory\OptionMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'workorder-option-index' => array(
                'title' => 'Work Order Options',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/work-order/option',
                    'defaults' => array(
                        'controller' => 'WorkorderOption\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-option-update' => array(
                'title' => 'Edit Work Order Options',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/work-order/option/update',
                    'defaults' => array(
                        'controller' => 'WorkorderOption\Controller\UpdateController',
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
)
;