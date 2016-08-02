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
        'AccountLedger' => array(
            'name' => 'AccountLedger',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(
                    'account-ledger-view',
                    'account-ledger-create'
                ),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'AccountLedger\Controller\View' => 'AccountLedger\Controller\Factory\ViewControllerFactory',
            'AccountLedger\Controller\Create' => 'AccountLedger\Controller\Factory\CreateControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'AccountLedger\Service\LedgerServiceInterface' => 'AccountLedger\Service\Factory\LedgerServiceFactory',
            'AccountLedger\Mapper\LedgerMapperInterface' => 'AccountLedger\Mapper\Factory\LedgerMapperFactory',
            'AccountLedger\Form\LedgerForm' => 'AccountLedger\Form\Factory\LedgerFormFactory',
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'account-ledger-view' => array(
                'title' => 'View Account',
                'type' => 'segment',
                'options' => array(
                    'route' => '/account/[:accountId]/ledger[:accountLedgerId]/view',
                    'defaults' => array(
                        'controller' => 'AccountLedger\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
            'account-ledger-create' => array(
                'title' => 'Create Ledger Item',
                'type' => 'segment',
                'options' => array(
                    'route' => '/account/[:accountId]/ledger/create',
                    'defaults' => array(
                        'controller' => 'AccountLedger\Controller\Create',
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
    )
);
