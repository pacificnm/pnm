<?php
return array(
    'module' => array(
        'Ticket' => array(
            'name' => 'Ticket',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'ticket-index',
                    'ticket-create',
                    'ticket-view',
                    'ticket-update'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'ticket-delete',
                    'ticket-close'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'Ticket\Controller\IndexController' => 'Ticket\Controller\Factory\IndexControllerFactory',
            'Ticket\Controller\CreateController' => 'Ticket\Controller\Factory\CreateControllerFactory',
            'Ticket\Controller\ViewController' => 'Ticket\Controller\Factory\ViewControllerFactory',
            'Ticket\Controller\EmployeeController' => 'Ticket\Controller\Factory\EmployeeControllerFactory',
            'Ticket\Controller\DeleteController' => 'Ticket\Controller\Factory\DeleteControllerFactory',
            'Ticket\Controller\CloseController' => 'Ticket\Controller\Factory\CloseControllerFactory'
        )
    ),
    'controller_plugins' => array(
        'factories' => array(
            'SetTicketHistory' => 'Ticket\Controller\Plugin\Factory\TicketHistoryPluginFactory',
            'GetTicket' => 'Ticket\Controller\Plugin\Factory\TicketControllerPluginFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Ticket\Service\TicketServiceInterface' => 'Ticket\Service\Factory\TicketServiceFactory',
            'Ticket\Mapper\MysqlMapperInterface' => 'Ticket\Mapper\Factory\MysqlMapperFactory',
            'Ticket\Listener\TicketListener' => 'Ticket\Listener\Factory\TicketListenerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'ticket-index' => array(
                'title' => 'Client Support Tickets',
                'type' => 'segment',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'ticket-index',
                'options' => array(
                    'route' => '/client/[:clientId]/ticket',
                    'defaults' => array(
                        'controller' => 'Ticket\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'ticket-create' => array(
                'title' => 'New Support Ticket',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'ticket-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/ticket/create',
                    'defaults' => array(
                        'controller' => 'Ticket\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            
            'ticket-view' => array(
                'title' => 'View Support Ticket',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'ticket-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/ticket/[:ticketId]/view',
                    'defaults' => array(
                        'controller' => 'Ticket\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'ticket-update' => array(
                'title' => 'Edit Support Ticket',
                'type' => 'segment',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'ticket-index',
                'options' => array(
                    'route' => '/client/[:clientId]/ticket/[:ticketId]/update',
                    'defaults' => array(
                        'controller' => 'Ticket\Controller\EmployeeController',
                        'action' => 'index'
                    )
                )
            ),
            'ticket-close' => array(
                'title' => 'Close Support Ticket',
                'type' => 'segment',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'ticket-index',
                'options' => array(
                    'route' => '/client/[:clientId]/ticket/[:ticketId]/close',
                    'defaults' => array(
                        'controller' => 'Ticket\Controller\CloseController',
                        'action' => 'index'
                    )
                )
            ),
            'ticket-delete' => array(
                'title' => 'Delete Support Ticket',
                'type' => 'segment',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'ticket-index',
                'options' => array(
                    'route' => '/client/[:clientId]/ticket/[:ticketId]/delete',
                    'defaults' => array(
                        'controller' => 'Ticket\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'Ticket' => 'Ticket\View\Helper\Factory\TicketViewHelperFactory'
        )
    ),
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        ),
        'strategies' => array(
            0 => 'ViewJsonStrategy'
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
                                'label' => 'Support Tickets',
                                'route' => 'ticket-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'View',
                                        'route' => 'ticket-view',
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
        'default' => array(
            'client' => array(
                array(
                    'label' => 'Support Tickets',
                    'icon' => 'fa fa-life-ring',
                    'route' => 'ticket-index',
                    'resource' => 'ticket-index',
                    'order' => 11,
                    'useRouteMatch' => true
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
    )
);