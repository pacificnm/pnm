<?php
return array(
    'module' => array(
        'Workorder' => array(
            'name' => 'Workorder',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    0 => 'workorder-list',
                    1 => 'workorder-view',
                    2 => 'workorder-print'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    0 => 'workorder-create',
                    1 => 'workorder-delete',
                    2 => 'workorder-update',
                    3 => 'workorder-complete',
                    4 => 'workorder-signature'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'Workorder\\Controller\\Create' => 'Workorder\\Controller\\Factory\\CreateControllerFactory',
            'Workorder\\Controller\\Delete' => 'Workorder\\Controller\\Factory\\DeleteControllerFactory',
            'Workorder\\Controller\\Index' => 'Workorder\\Controller\\Factory\\IndexControllerFactory',
            'Workorder\\Controller\\Update' => 'Workorder\\Controller\\Factory\\UpdateControllerFactory',
            'Workorder\\Controller\\View' => 'Workorder\\Controller\\Factory\\ViewControllerFactory',
            'Workorder\\Controller\\Print' => 'Workorder\\Controller\\Factory\\PrintControllerFactory',
            'Workorder\\Controller\\Complete' => 'Workorder\\Controller\\Factory\\CompleteControllerFactory',
            'Workorder\Controller\SignatureController' => 'Workorder\Controller\Factory\SignatureControllerFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Workorder\\Service\\WorkorderServiceInterface' => 'Workorder\\Service\\Factory\\WorkorderServiceFactory',
            'Workorder\\Mapper\\WorkorderMapperInterface' => 'Workorder\\Mapper\\Factory\\WorkorderMapperFactory',
            'Workorder\\Form\\WorkorderForm' => 'Workorder\\Form\\Factory\\WorkorderFormFactory',
            'Workorder\\V1\\Rest\\ClientTotalCount\\ClientTotalCountResource' => 'Workorder\\V1\\Rest\\ClientTotalCount\\ClientTotalCountResourceFactory',
            'Workorder\\V1\\Rest\\ClientTotalLabor\\ClientTotalLaborResource' => 'Workorder\\V1\\Rest\\ClientTotalLabor\\ClientTotalLaborResourceFactory',
            'Workorder\\V1\\Rest\\Schedule\\ScheduleResource' => 'Workorder\\V1\\Rest\\Schedule\\ScheduleResourceFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'workorder-list' => array(
                'title' => 'Client Work Orders',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order',
                    'defaults' => array(
                        'controller' => 'Workorder\\Controller\\Index',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-create' => array(
                'title' => 'Create Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/create',
                    'defaults' => array(
                        'controller' => 'Workorder\\Controller\\Create',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-delete' => array(
                'title' => 'Delete Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/delete/[:workorderId]',
                    'defaults' => array(
                        'controller' => 'Workorder\\Controller\\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-update' => array(
                'title' => 'Edit Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/update/[:workorderId]',
                    'defaults' => array(
                        'controller' => 'Workorder\\Controller\\Update',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-view' => array(
                'title' => 'View Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/view',
                    'defaults' => array(
                        'controller' => 'Workorder\\Controller\\View',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-print' => array(
                'title' => 'Print',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/print/[:workorderId]',
                    'defaults' => array(
                        'controller' => 'Workorder\\Controller\\Print',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-complete' => array(
                'title' => 'Complete Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/complete/[:workorderId]',
                    'defaults' => array(
                        'controller' => 'Workorder\\Controller\\Complete',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-signature' => array(
                'title' => 'Complete Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/signature/[:workorderId]',
                    'defaults' => array(
                        'controller' => 'Workorder\Controller\SignatureController',
                        'action' => 'index'
                    )
                )
            ),
            
            'workorder.rest.client-total-count' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/workorder/client-total-count',
                    'defaults' => array(
                        'controller' => 'Workorder\\V1\\Rest\\ClientTotalCount\\Controller'
                    )
                )
            ),
            'workorder.rest.client-total-labor' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/workorder/client-total-labor',
                    'defaults' => array(
                        'controller' => 'Workorder\\V1\\Rest\\ClientTotalLabor\\Controller'
                    )
                )
            ),
            'workorder.rest.schedule' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/workorder/schedule',
                    'defaults' => array(
                        'controller' => 'Workorder\\V1\\Rest\\Schedule\\Controller'
                    )
                )
            )
        )
    ),
    'view_helpers' => array(
        'invokables' => array(
            'WorkorderSignature' => 'Workorder\View\Helper\WorkorderSignature'
        ),
        'factories' => array(
            'GetEmployeeWorkorders' => 'Workorder\View\Helper\Factory\GetEmployeeWorkordersFactory'
        )
    ),
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
                        'label' => 'View Client',
                        'route' => 'client-view',
                        'resource' => 'client-view',
                        'useRouteMatch' => true,
                        'pages' => array(
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
                                            )
                                        )
                                    )
                                )
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
            array(
                'client' => array(
                    'title' => 'Client',
                    'icon' => '',
                    'route' => 'client-index',
                    'submenu' => array(
                        array(
                            'workorder' => array(
                                'title' => 'Work Orders',
                                'icon' => 'fa fa-wrench',
                                'route' => 'workorder-index'
                            )
                        )
                    )
                    
                )
            )
        )
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
    ),
    // api
    'zf-versioning' => array(
        'uri' => array(
            1 => 'workorder.rest.client-total-count',
            2 => 'workorder.rest.client-total-labor',
            0 => 'workorder.rest.schedule'
        )
    ),
    'zf-rest' => array(
        'Workorder\\V1\\Rest\\ClientTotalCount\\Controller' => array(
            'listener' => 'Workorder\\V1\\Rest\\ClientTotalCount\\ClientTotalCountResource',
            'route_name' => 'workorder.rest.client-total-count',
            'route_identifier_name' => 'client-total-count',
            'collection_name' => 'ClientTotalCount',
            'entity_http_methods' => array(
                0 => 'PATCH'
            ),
            'collection_http_methods' => array(
                0 => 'GET'
            ),
            'collection_query_whitelist' => array(
                0 => 'client',
                1 => 'status'
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Workorder\\V1\\Rest\\ClientTotalCount\\ClientTotalCountEntity',
            'collection_class' => 'Workorder\\V1\\Rest\\ClientTotalCount\\ClientTotalCountCollection',
            'service_name' => 'ClientTotalCount'
        ),
        'Workorder\\V1\\Rest\\ClientTotalLabor\\Controller' => array(
            'listener' => 'Workorder\\V1\\Rest\\ClientTotalLabor\\ClientTotalLaborResource',
            'route_name' => 'workorder.rest.client-total-labor',
            'route_identifier_name' => 'client-total-labor',
            'entity_http_methods' => array(),
            'collection_http_methods' => array(
                0 => 'GET'
            ),
            'collection_query_whitelist' => array(
                0 => 'client',
                1 => 'status'
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Workorder\\V1\\Rest\\ClientTotalLabor\\ClientTotalLaborEntity',
            'collection_class' => 'Workorder\\V1\\Rest\\ClientTotalLabor\\ClientTotalLaborCollection',
            'service_name' => 'ClientTotalLabor'
        ),
        'Workorder\\V1\\Rest\\Schedule\\Controller' => array(
            'listener' => 'Workorder\\V1\\Rest\\Schedule\\ScheduleResource',
            'route_name' => 'workorder.rest.schedule',
            'route_identifier_name' => 'workorder-schedule',
            'collection_name' => 'schedule',
            'entity_http_methods' => array(
                0 => 'DELETE'
            ),
            'collection_http_methods' => array(
                0 => 'GET'
            ),
            'collection_query_whitelist' => array(
                0 => 'client',
                1 => 'employee',
                2 => 'start',
                3 => 'end'
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Workorder\\Entity\\WorkorderEntity',
            'collection_class' => 'Workorder\\V1\\Rest\\Schedule\\ScheduleCollection',
            'service_name' => 'Schedule'
        )
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Workorder\\V1\\Rest\\ClientTotalCount\\Controller' => 'HalJson',
            'Workorder\\V1\\Rest\\ClientTotalLabor\\Controller' => 'HalJson',
            'Workorder\\V1\\Rest\\Schedule\\Controller' => 'HalJson'
        ),
        'accept_whitelist' => array(
            'Workorder\\V1\\Rest\\ClientTotalCount\\Controller' => array(
                0 => 'application/vnd.workorder.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json'
            ),
            'Workorder\\V1\\Rest\\ClientTotalLabor\\Controller' => array(
                0 => 'application/vnd.workorder.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json'
            ),
            'Workorder\\V1\\Rest\\Schedule\\Controller' => array(
                0 => 'application/vnd.workorder.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json'
            )
        ),
        'content_type_whitelist' => array(
            'Workorder\\V1\\Rest\\ClientTotalCount\\Controller' => array(
                0 => 'application/vnd.workorder.v1+json',
                1 => 'application/json'
            ),
            'Workorder\\V1\\Rest\\ClientTotalLabor\\Controller' => array(
                0 => 'application/vnd.workorder.v1+json',
                1 => 'application/json'
            ),
            'Workorder\\V1\\Rest\\Schedule\\Controller' => array(
                0 => 'application/vnd.workorder.v1+json',
                1 => 'application/json'
            )
        )
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Workorder\\V1\\Rest\\ClientTotalCount\\ClientTotalCountEntity' => array(
                'entity_identifier_name' => 'workorderId',
                'route_name' => 'workorder.rest.client-total-count',
                'route_identifier_name' => 'client-total-count',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable'
            ),
            'Workorder\\V1\\Rest\\ClientTotalCount\\ClientTotalCountCollection' => array(
                'entity_identifier_name' => 'workorderId',
                'route_name' => 'workorder.rest.client-total-count',
                'route_identifier_name' => 'client-total-count',
                'is_collection' => true
            ),
            'Workorder\\V1\\Rest\\ClientTotalLabor\\ClientTotalLaborEntity' => array(
                'entity_identifier_name' => 'workorderId',
                'route_name' => 'workorder.rest.client-total-labor',
                'route_identifier_name' => 'client-total-labor',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable'
            ),
            'Workorder\\V1\\Rest\\ClientTotalLabor\\ClientTotalLaborCollection' => array(
                'entity_identifier_name' => 'workorderId',
                'route_name' => 'workorder.rest.client-total-labor',
                'route_identifier_name' => 'client-total-labor',
                'is_collection' => true
            ),
            'Workorder\\V1\\Rest\\Schedule\\ScheduleEntity' => array(
                'entity_identifier_name' => 'workorderId',
                'route_name' => 'workorder.rest.schedule',
                'route_identifier_name' => 'workorer-schedule',
                'hydrator' => 'Workorder\\Hydrator\\WorkorderHydrator'
            ),
            'Workorder\\V1\\Rest\\Schedule\\ScheduleCollection' => array(
                'entity_identifier_name' => 'workorderId',
                'route_name' => 'workorder.rest.schedule',
                'route_identifier_name' => 'workorder-schedule',
                'is_collection' => true
            ),
            'Workorder\\Entity\\WorkorderEntity' => array(
                'entity_identifier_name' => 'workorderId',
                'route_name' => 'workorder.rest.schedule',
                'route_identifier_name' => 'workorder-schedule',
                'hydrator' => 'Workorder\\Hydrator\\WorkorderHydrator'
            )
        )
    )
);
