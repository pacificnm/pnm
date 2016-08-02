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
        'WorkorderCredit' => array(
            'name' => 'WorkorderCredit',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'workorder-credit-create',
                    'workorder-credit-view'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderCredit\Controller\Create' => 'WorkorderCredit\Controller\Factory\CreateControllerFactory',
            'WorkorderCredit\Controller\View' => 'WorkorderCredit\Controller\Factory\ViewControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderCredit\Service\CreditServiceInterface' => 'WorkorderCredit\Service\Factory\CreditServiceFactory',
            'WorkorderCredit\Mapper\CreditMapperInterface' => 'WorkorderCredit\Mapper\Factory\CreditMapperFactory',
            'WorkorderCredit\Form\CreditForm' => 'WorkorderCredit\Form\Factory\CreditFormFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'workorder-credit-create' => array(
                'title' => 'Create Work Order Credit',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-credit/create',
                    'defaults' => array(
                        'controller' => 'WorkorderCredit\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-credit-view' => array(
                'title' => 'View Work Order Credit',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-credit/[:workorderCreditId]/view',
                    'defaults' => array(
                        'controller' => 'WorkorderCredit\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'GetWorkorderCredit' => 'WorkorderCredit\View\Helper\Factory\GetWorkorderCreditFactory'
        ),
        'invokables' => array()
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);