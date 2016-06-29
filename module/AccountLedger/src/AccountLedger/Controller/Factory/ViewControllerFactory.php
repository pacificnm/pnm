<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace AccountLedger\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AccountLedger\Controller\ViewController;

/**
 * 
 * @author jaimie
 *
 */
class ViewControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        $ledgerService = $realServiceLocator->get('AccountLedger\Service\LedgerServiceInterface');
        
        return new ViewController($accountService, $ledgerService);
    }
}