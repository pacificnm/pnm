<?php
/**
 * Configuration file generated by ZFTool
 * The previous configuration file is stored in application.config.old
 *
 * @see https://github.com/zendframework/ZFTool
 */
return array(
    'modules' => array(
        'ZF\\Apigility',
        'ZF\\Apigility\\Provider',
        'AssetManager',
        'ZF\\ApiProblem',
        'ZF\\MvcAuth',
        'ZF\\OAuth2',
        'ZF\\Hal',
        'ZF\\ContentNegotiation',
        'ZF\\ContentValidation',
        'ZF\\Rest',
        'ZF\\Rpc',
        'ZF\\Versioning',
        'ZF\\DevelopmentMode',
        'DhErrorLogging',
        'Application',
        'Acl',
        'Client',
        'Email',
        'Employee',
        'File',
        'Help',
        'Host',
        'HostType',
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
        'HostAttribute',
        'HostAttributeValue',
        'Account',
        'AccountLedger',
        'Update',
        'AccountType',
        'ClientAccount',
        'VendorAccount',
        'AclRole',
        'AclResource',
        'VendorBill',
        'VendorPayment',
        'HostAttributeMap',
        'Estimate',
        'EstimateOption',
        'EstimateOptionItem',
        'CallLog',
        'CallLogNote',
        'WorkorderOption',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ),
        'config_cache_enabled' => false,
        'config_cache_key' => '2245023265ae4cf87d02c8b6ba991139',
        'module_map_cache_enabled' => false,
        'module_map_cache_key' => '496fe9daf9baed5ab03314f04518b928',
        'cache_dir' => './data/cache/modulecache',
    ),
);
