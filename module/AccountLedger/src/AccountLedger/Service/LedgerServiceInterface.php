<?php
namespace AccountLedger\Service;

use AccountLedger\Entity\LedgerEntity;

interface LedgerServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return LedgerEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return LedgerEntity
     */
    public function get($id);

    /**
     *
     * @param LedgerEntity $entity            
     * @return LedgerEntity
     */
    public function save(LedgerEntity $entity);

    /**
     *
     * @param LedgerEntity $entity            
     * @return boolean
     */
    public function delete(LedgerEntity $entity);
    
    /**
     * 
     * @param unknown $accountId
     * @param unknown $fromAccountId
     * @param unknown $accountLedgerType
     * @param unknown $accountLedgerCreditAmount
     * @param unknown $accountLedgerDebitAmount
     * @param unknown $accountLedgerBalance
     * @param unknown $invoiceId
     * @param unknown $paymentId
     */
    public function createLedgerEntry($accountId, $fromAccountId, $accountLedgerType, $accountLedgerCreditAmount, $accountLedgerDebitAmount, $accountLedgerBalance, $invoiceId, $paymentId);
}
