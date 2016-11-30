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
                    'estimate-view',
                    'estimate-index'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    
                    'estimate-create',
                    'estimate-update',
                    'estimate-delete',
                    'estimate-print'
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
            'Estimate\Controller\ViewController' => 'Estimate\Controller\Factory\ViewControllerFactory',
            'Estimate\\Controller\\PrintController' => 'Estimate\Controller\Factory\PrintControllerFactory'
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
                'title' => 'Estimate',
                'pageTitle' => 'Estimate',
                'pageSubTitle' => '',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'esitmate-index',
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
                'title' => 'Estimate',
                'pageTitle' => 'Estimate',
                'pageSubTitle' => 'New',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'esitmate-index',
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
                'title' => 'Estimate',
                'pageTitle' => 'Estimate',
                'pageSubTitle' => 'Edit',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'esitmate-index',
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
                'title' => 'Estimate',
                'pageTitle' => 'Estimate',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'esitmate-index',
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
            ),
            'estimate-print' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/estimate/print/[:estimateId]',
                    'defaults' => array(
                        'controller' => 'Estimate\\Controller\\PrintController',
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
    ),
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Clients',
                'route' => 'client-index',
                'resource' => 'client-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'View',
                        'route' => 'estimate-view',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Edit Estimate',
                                'route' => 'estimate-update',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'Delete Estimate',
                                'route' => 'estimate-delete',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'New Item',
                                'route' => 'estimate-option-item-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'Edit Item',
                                'route' => 'estimate-option-item-update',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'Delete Item',
                                'route' => 'estimate-option-item-delete',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'New Option',
                                'route' => 'estimate-option-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'Edit Option',
                                'route' => 'estimate-option-update',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'Delete Option',
                                'route' => 'estimate-option-update',
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
        'default' => array(
            'client' => array(
                array(
                    'label' => 'Estimates',
                    'icon' => 'fa fa-newspaper-o',
                    'route' => 'estimate-index',
                    'resource' => 'estimate-index',
                    'order' => 4,
                    'useRouteMatch' => true
                )
            )
        )
        
    )
);