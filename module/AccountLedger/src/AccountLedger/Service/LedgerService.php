<?php
namespace AccountLedger\Service;

use AccountLedger\Entity\LedgerEntity;
use AccountLedger\Mapper\LedgerMapperInterface;
use Account\Service\AccountServiceInterface;

class LedgerService implements LedgerServiceInterface
{

    /**
     * 
     * @var LedgerMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @var AccountServiceInterface
     */
    protected $accountService;
    
    /**
     * 
     * @param LedgerMapperInterface $mapper
     * @param AccountServiceInterface $accountService
     */
    public function __construct(LedgerMapperInterface $mapper, AccountServiceInterface $accountService)
    {
        $this->mapper = $mapper;
        
        $this->accountService = $accountService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::save()
     */
    public function save(LedgerEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::delete()
     */
    public function delete(LedgerEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::createLedgerEntry()
     */
    public function createLedgerEntry($accountId, $fromAccountId, $accountLedgerType, $accountLedgerCreditAmount, $accountLedgerDebitAmount, $accountLedgerBalance, $invoiceId, $paymentId)
    {
        $ledgerEntity = new LedgerEntity();
        
        $ledgerEntity->setAccountId($accountId);
        $ledgerEntity->setAccountLedgerBalance($accountLedgerBalance);
        $ledgerEntity->setAccountLedgerCreate(time());
        $ledgerEntity->setAccountLedgerCreditAmount($accountLedgerCreditAmount);
        $ledgerEntity->setAccountLedgerDebitAmount($accountLedgerDebitAmount);
        $ledgerEntity->setAccountLedgerId(0);
        $ledgerEntity->setAccountLedgerType($accountLedgerType);
        $ledgerEntity->setFromAccountId($fromAccountId);
        $ledgerEntity->setInvoiceId($invoiceId);
        $ledgerEntity->setPaymentId($paymentId);
        
        $ledgerEntity = $this->mapper->save($ledgerEntity);
        
        return $ledgerEntity;
    }
}