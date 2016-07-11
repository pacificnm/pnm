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
        'EstimateOption' => array(
            'name' => 'EstimateOption',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'estimate-option-view'
                ),
                'employee' => array(
                    'estimate-option-index',
                    'estimate-option-create',
                    'estimate-option-update',
                    'estimate-option-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    // controllers
    'controllers' => array(
        'factories' => array(
            'EstimateOption\Controller\CreateController' => 'EstimateOption\Controller\Factory\CreateControllerFactory',
            'EstimateOption\Controller\DeleteController' => 'EstimateOption\Controller\Factory\DeleteControllerFactory',
            'EstimateOption\Controller\IndexController' => 'EstimateOption\Controller\Factory\IndexControllerFactory',
            'EstimateOption\Controller\UpdateController' => 'EstimateOption\Controller\Factory\UpdateControllerFactory',
            'EstimateOption\Controller\ViewController' => 'EstimateOption\Controller\Factory\ViewControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'EstimateOption\Service\OptionServiceInterface' => 'EstimateOption\Service\Factory\OptionServiceFactory',
            'EstimateOption\Mapper\OptionMapperInterface' => 'EstimateOption\Mapper\Factory\OptionMapperFactory'
        )
    ),
    // router
    'router' => array(
        'routes' => array(
            'estimate-option-index' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate-option',
                    'defaults' => array(
                        'controller' => 'EstimateOption\\Controller\\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-option-create' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/[:estimateId]/estimate-option/create',
                    'defaults' => array(
                        'controller' => 'EstimateOption\\Controller\\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-option-update' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/[:estimateId]/estimate-option/update/[:estimateOptionId]',
                    'defaults' => array(
                        'controller' => 'EstimateOption\\Controller\\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-option-delete' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/[:estimateId]/estimate-option/delete/[:estimateOptionId]',
                    'defaults' => array(
                        'controller' => 'EstimateOption\\Controller\\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-option-view' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/[:estimateId]/estimate-option/view/[:estimateOptionId]',
                    'defaults' => array(
                        'controller' => 'EstimateOption\\Controller\\ViewController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    )
);