<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace AccountLedger\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use AccountLedger\Form\LedgerForm;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *         
 */
class LedgerFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \AccountLedger\Form\LedgerForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $accountService = $serviceLocator->get('Account\Service\AccountServiceInterface');
        
        return new LedgerForm($accountService);
    }
}