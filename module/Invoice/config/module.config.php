<?php
return array(
    'module' => array(
        'Invoice' => array(
            'name' => 'Invoice',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'invoice-list',
                    'invoice-print',
                    'invoice-view'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'invoice-create',
                    'invoice-delete',
                    'invoice-update',
                    'invoice-workorder',
                    'invoice-workorder-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Invoice\Controller\Create' => 'Invoice\Controller\Factory\CreateControllerFactory',
            'Invoice\Controller\Delete' => 'Invoice\Controller\Factory\DeleteControllerFactory',
            'Invoice\Controller\Index' => 'Invoice\Controller\Factory\IndexControllerFactory',
            'Invoice\Controller\Print' => 'Invoice\Controller\Factory\PrintControllerFactory',
            'Invoice\Controller\Update' => 'Invoice\Controller\Factory\UpdateControllerFactory',
            'Invoice\Controller\View' => 'Invoice\Controller\Factory\ViewControllerFactory',
            'Invoice\Controller\Workorder' => 'Invoice\Controller\Factory\WorkorderControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Invoice\Service\InvoiceServiceInterface' => 'Invoice\Service\Factory\InvoiceServiceFactory',
            'Invoice\Mapper\InvoiceMapperInterface' => 'Invoice\Mapper\Factory\InvoiceMapperFactory',
            'Invoice\Form\WorkorderForm' => 'Invoice\Form\Factory\WorkorderFormFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'invoice-list' => array(
                'title' => 'Client Invoices',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-create' => array(
                'title' => 'Create Invoice',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/create',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-delete' => array(
                'title' => 'Delete Invoice',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/delete/[:invoiceId]',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-print' => array(
                'title' => 'Print',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/print/[:invoiceId]',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Print',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-update' => array(
                'title' => 'Edit Invoice',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/update/[:invoiceId]',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-workorder' => array(
                'title' => 'Add Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/[:invoiceId]/work-order/create',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Workorder',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-workorder-delete' => array(
                'title' => 'Add Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/[:invoiceId]/work-order/[:workorderId]/delete',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Workorder',
                        'action' => 'delete'
                    )
                )
            ),
            'invoice-view' => array(
                'title' => 'View Invoice',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/view/[:invoiceId]',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\View',
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
                'label' => 'Clients',
                'route' => 'client-index',
                'resource' => 'client-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Invoices',
                        'route' => 'invoice-list',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Create Invoice',
                                'route' => 'invoice-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View Invoice',
                                'route' => 'invoice-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit Invoice',
                                        'route' => 'invoice-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete Invoice',
                                        'route' => 'invoice-delete',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Print Invoice',
                                        'route' => 'invoice-print',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete Payment',
                                        'route' => 'invoice-payemnt-delete',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete Invoice Item',
                                        'route' => 'invoice-item-delete',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Add Work Order',
                                        'route' => 'invoice-workorder',
                                        'useRouteMatch' => true
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
        'default' => array()
    ),
    // acl
    'acl' => array(
        'default' => array()
    )
);