<?php
/**
 * Configuration file generated by ZFTool
 * The previous configuration file is stored in application.config.old
 *
 * @see https://github.com/zendframework/ZFTool
 */
return array(
    'modules' => array(
        'ZendDeveloperTools',
        'BjyProfiler',
        'Application',
        'Acl',
        'Client',
        'Email',
        'Employee',
        'File',
        'Help',
        'Host',
        'Invoice',
        'Labor',
        'Location',
        'Message',
        'Milage',
        'Network',
        'Notification',
        'Password',
        'Phone',
        'User',
        'Vendor',
        'Workorder',
        'Auth',
        'Task',
        'Admin',
        'Config',
        'WorkorderEmployee',
        'WorkorderNote',
        'WorkorderPart',
        'WorkorderTime',
        'WorkorderFile',
        'NetworkAttributeMap',
        'NetworkAttribute',
        'NetworkAttributeValue',
        'InvoiceItem',
        'InvoiceOption',
        'InvoicePayment',
        'ClientFavorite',
        'History',
        'Install',
        'PaymentOption',
        'WorkorderCredit',
        'TaskNote',
        'TaskPriority',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ),
    ),
);
