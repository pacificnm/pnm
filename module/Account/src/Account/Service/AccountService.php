<?php
namespace Account\Service;

use Account\Entity\AccountEntity;
use Account\Mapper\AccountMapperInterface;
use AccountLedger\Entity\LedgerEntity;
use AccountLedger\Service\LedgerServiceInterface;

class AccountService implements AccountServiceInterface
{

    /**
     *
     * @var AccountMapperInterface
     */
    protected $mapper;

    /**
     *
     * @var LedgerServiceInterface
     */
    protected $ledgerService;

    /**
     *
     * @param AccountMapperInterface $mapper            
     * @param LedgerServiceInterface $ledgerService            
     */
    public function __construct(AccountMapperInterface $mapper, LedgerServiceInterface $ledgerService)
    {
        $this->mapper = $mapper;
        
        $this->ledgerService = $ledgerService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Account\Service\AccountServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Account\Service\AccountServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Account\Service\AccountServiceInterface::getNonSystemAccounts()
     */
    public function getNonSystemAccounts()
    {
        return $this->mapper->getNonSystemAccounts();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Account\Service\AccountServiceInterface::getAccountsByType()
     */
    public function getAccountsByType($accountTypeId)
    {
        $filter = array(
            'accountTypeId' => $accountTypeId
        );
        
        return $this->mapper->getAll($filter);
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Account\Service\AccountServiceInterface::save()
     */
    public function save(AccountEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Account\Service\AccountServiceInterface::delete()
     */
    public function delete(AccountEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Account\Service\AccountServiceInterface::addLedgerCreditItem()
     */
    public function addLedgerCreditItem($accountId, $fromAccountId, $ledgerAmount, $ledgerMemo)
    {
        $accountEntity = $this->mapper->get($accountId);
        
        // create ledger items
        $ledgerEntity = new LedgerEntity();
        
        $ledgerEntity->setAccountId($accountId);
        
        $ledgerEntity->setFromAccountId($fromAccountId);
        
        $ledgerEntity->setAccountLedgerCreate(time());
        
        $ledgerEntity->setAccountLedgerCreditAmount($ledgerAmount);
        
        $ledgerEntity->setAccountLedgerDebitAmount(0);
        
        $ledgerEntity->setAccountLedgerType('Deposit');
        
        $ledgerEntity->setAccountLedgerMemo($ledgerMemo);
        
        // update balance add
        $ledgerEntity->setAccountLedgerBalance($accountEntity->getAccountBalance() + $ledgerAmount);
        
        $ledgerEntity = $this->ledgerService->save($ledgerEntity);
        
        // update account balance
        $accountEntity->setAccountBalance($accountEntity->getAccountBalance() + $ledgerAmount);
        
        $this->mapper->save($accountEntity);
        
        return $ledgerEntity;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Account\Service\AccountServiceInterface::addLedgerDebitItem()
     */
    public function addLedgerDebitItem($accountId, $fromAccountId, $ledgerAmount, $ledgerMemo)
    {
        $accountEntity = $this->mapper->get($accountId);
        
        // create ledger items
        $ledgerEntity = new LedgerEntity();
        
        $ledgerEntity->setAccountId($accountId);
        
        $ledgerEntity->setFromAccountId($fromAccountId);
        
        $ledgerEntity->setAccountLedgerCreate(time());
        
        $ledgerEntity->setAccountLedgerCreditAmount(0);
        
        $ledgerEntity->setAccountLedgerDebitAmount($ledgerAmount);
        
        $ledgerEntity->setAccountLedgerType('Withdrawal');
        
        $ledgerEntity->setAccountLedgerBalance($accountEntity->getAccountBalance() - $ledgerAmount);
        
        $ledgerEntity->setAccountLedgerMemo($ledgerMemo);
        
        $ledgerEntity = $this->ledgerService->save($ledgerEntity);
        
        // update account balance subtract
        $accountEntity->setAccountBalance($accountEntity->getAccountBalance() - $ledgerAmount);
        
        $this->mapper->save($accountEntity);
        
        // return ledger item
        return $ledgerEntity;
    }
}