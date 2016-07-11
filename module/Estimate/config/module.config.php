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
        'Estimate' => array(
            'name' => 'Estimate',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'estimate-view'
                ),
                'employee' => array(
                    'estimate-index',
                    'estimate-create',
                    'estimate-update',
                    'estimate-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    // contorllers
    'controllers' => array(
        'factories' => array(
            'Estimate\Controller\CreateController' => 'Estimate\Controller\Factory\CreateControllerFactory',
            'Estimate\Controller\DeleteController' => 'Estimate\Controller\Factory\DeleteControllerFactory',
            'Estimate\Controller\IndexController' => 'Estimate\Controller\Factory\IndexControllerFactory',
            'Estimate\Controller\UpdateController' => 'Estimate\Controller\Factory\UpdateControllerFactory',
            'Estimate\Controller\ViewController' => 'Estimate\Controller\Factory\ViewControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Estimate\Mapper\EstimateMapperInterface' => 'Estimate\Mapper\Factory\EstimateMapperFactory',
            'Estimate\Service\EstimateServiceInterface' => 'Estimate\Service\Factory\EstimateServiceFactory'
        )
    ),
    // router
    'router' => array(
        'routes' => array(
            'estimate-index' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate',
                    'defaults' => array(
                        'controller' => 'Estimate\\Controller\\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-create' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/create',
                    'defaults' => array(
                        'controller' => 'Estimate\\Controller\\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-update' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/update/[:estimateId]',
                    'defaults' => array(
                        'controller' => 'Estimate\\Controller\\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-delete' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/delete/[:estimateId]',
                    'defaults' => array(
                        'controller' => 'Estimate\\Controller\\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
            'estimate-view' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/view/[:estimateId]',
                    'defaults' => array(
                        'controller' => 'Estimate\\Controller\\ViewController',
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