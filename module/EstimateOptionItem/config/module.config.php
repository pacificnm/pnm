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
        'EstimateOptionItem' => array(
            'name' => 'EstimateOptionItem',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'estimate-option-item-view'
                ),
                'employee' => array(
                    'estimate-option-item-index',
                    'estimate-option-item-create',
                    'estimate-option-item-update',
                    'estimate-option-item-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    // controllers
    'controllers' => array(
        'factories' => array(
            'EstimateOptionItem\Controller\CreateController' => 'EstimateOptionItem\Controller\Factory\CreateControllerFactory',
            'EstimateOptionItem\Controller\DeleteController' => 'EstimateOptionItem\Controller\Factory\DeleteControllerFactory',
            'EstimateOptionItem\Controller\IndexController' => 'EstimateOptionItem\Controller\Factory\IndexControllerFactory',
            'EstimateOptionItem\Controller\UpdateController' => 'EstimateOptionItem\Controller\Factory\UpdateControllerFactory',
            'EstimateOptionItem\Controller\ViewController' => 'EstimateOptionItem\Controller\Factory\ViewControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'EstimateOptionItem\Service\ItemServiceInterface' => 'EstimateOptionItem\Service\Factory\ItemServiceFactory',
            'EstimateOptionItem\Mapper\ItemMapperInterface' => 'EstimateOptionItem\Mapper\Factory\ItemMapperFactory'
        )
    ),
    // router
    'router' => array(
        'routes' => array(
            'estimate-option-item-index' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate-option',
                    'defaults' => array(
                        'controller' => 'EstimateOptionItem\\Controller\\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-option-item-create' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/[:estimateId]/estimate-option/[:estimateOptionId]/estimate-option-item/create',
                    'defaults' => array(
                        'controller' => 'EstimateOptionItem\\Controller\\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-option-item-update' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/[:estimateId]/estimate-option/[:estimateOptionId]/estimate-option-item/[:estimateOptionItemId]update',
                    'defaults' => array(
                        'controller' => 'EstimateOptionItem\\Controller\\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-option-item-delete' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/[:estimateId]/estimate-option/[:estimateOptionId]/estimate-option-item/[:estimateOptionItemId]/delete',
                    'defaults' => array(
                        'controller' => 'EstimateOptionItem\\Controller\\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-option-item-view' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/[:estimateId]/estimate-option/[:estimateOptionId]/estimate-option-item/[:estimateOptionItemId]/view',
                    'defaults' => array(
                        'controller' => 'EstimateOptionItem\\Controller\\ViewController',
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