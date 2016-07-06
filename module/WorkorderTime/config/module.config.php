<?php
return array(
    'module' => array(
        'WorkorderTime' => array(
            'name' => 'WorkorderTime',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(
                    0 => 'workorder-time-create',
                    1 => 'workorder-time-delete',
                ),
                'accountant' => array(),
                'administrator' => array(),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'WorkorderTime\\Controller\\Create' => 'WorkorderTime\\Controller\\Factory\\CreateControllerFactory',
            'WorkorderTime\\Controller\\Delete' => 'WorkorderTime\\Controller\\Factory\\DeleteControllerFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'WorkorderTime\\Service\\TimeServiceInterface' => 'WorkorderTime\\Service\\Factory\\TimeServiceFactory',
            'WorkorderTime\\Mapper\\TimeMapperInterface' => 'WorkorderTime\\Mapper\\Factory\\TimeMapperFactory',
            'WorkorderTime\\Form\\TimeForm' => 'WorkorderTime\\Form\\Factory\\TimeFormFactory',
            'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\TotalsByDateRangeResource' => 'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\TotalsByDateRangeResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'workorder-time-create' => array(
                'title' => 'Create Work Order Time',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-time/create',
                    'defaults' => array(
                        'controller' => 'WorkorderTime\\Controller\\Create',
                        'action' => 'index',
                    ),
                ),
            ),
            'workorder-time-delete' => array(
                'title' => 'Delete Work Order Time',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-time/delete/[:workorderTimeId]',
                    'defaults' => array(
                        'controller' => 'WorkorderTime\\Controller\\Delete',
                        'action' => 'index',
                    ),
                ),
            ),
            'workorder-time.rest.totals-by-date-range' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/time/totals-by-date-range[/:totals_by_date_range_id]',
                    'defaults' => array(
                        'controller' => 'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'GetWorkorderTimes' => 'WorkorderTime\\View\\Helper\\Factory\\GetWorkorderTimesFactory',
            'SalesByLabor' => 'WorkorderTime\\View\\Helper\\Factory\\SalesByLaborFactory',
        ),
        'invokables' => array(),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view',
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'workorder-time.rest.totals-by-date-range',
        ),
    ),
    'zf-rest' => array(
        'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\Controller' => array(
            'listener' => 'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\TotalsByDateRangeResource',
            'route_name' => 'workorder-time.rest.totals-by-date-range',
            'route_identifier_name' => 'totals_by_date_range_id',
            'collection_name' => 'totals_by_date_range',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(
                0 => 'start',
                1 => 'end',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\TotalsByDateRangeEntity',
            'collection_class' => 'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\TotalsByDateRangeCollection',
            'service_name' => 'TotalsByDateRange',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\Controller' => array(
                0 => 'application/vnd.workorder-time.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\Controller' => array(
                0 => 'application/vnd.workorder-time.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\TotalsByDateRangeEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'workorder-time.rest.totals-by-date-range',
                'route_identifier_name' => 'totals_by_date_range_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'WorkorderTime\\V1\\Rest\\TotalsByDateRange\\TotalsByDateRangeCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'workorder-time.rest.totals-by-date-range',
                'route_identifier_name' => 'totals_by_date_range_id',
                'is_collection' => true,
            ),
        ),
    ),
);
