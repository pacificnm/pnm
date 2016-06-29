<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace AccountLedger\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use AccountLedger\Controller\CreateController;

/**
 * 
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \AccountLedger\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        $ledgerService = $realServiceLocator->get('AccountLedger\Service\LedgerServiceInterface');

        $ledgerForm = $realServiceLocator->get('AccountLedger\Form\LedgerForm');
        
        return new CreateController($accountService, $ledgerService, $ledgerForm);
    }
}
