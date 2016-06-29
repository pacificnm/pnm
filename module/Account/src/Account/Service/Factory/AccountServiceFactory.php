<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Account\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Account\Service\AccountService;

/**
 * 
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class AccountServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Account\Service\AccountService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Account\Mapper\AccountMapperInterface');
        
        $ledgerService = $serviceLocator->get('AccountLedger\Service\LedgerServiceInterface');
        
        return new AccountService($mapper, $ledgerService);
    }
}