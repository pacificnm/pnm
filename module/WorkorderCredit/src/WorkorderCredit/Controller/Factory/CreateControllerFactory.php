<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace WorkorderCredit\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCredit\Controller\CreateController;

/**
 * Create Credit Controller
 *
 * @author jaimie (pacificnm@gmail.com)
 *
 */
class CreateControllerFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $creditService = $realServiceLocator->get('WorkorderCredit\Service\CreditServiceInterface');
        
        $clientAccountService = $realServiceLocator->get('ClientAccount\Service\AccountServiceInterface');
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        $ledgerService = $realServiceLocator->get('AccountLedger\Service\LedgerServiceInterface');
        
        $creditForm = $realServiceLocator->get('WorkorderCredit\Form\CreditForm');
        
        return new CreateController($clientService, $workorderService, $creditService, $accountService, $clientAccountService, $ledgerService, $creditForm);
    }
}
