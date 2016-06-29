<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Account\Service;

use Account\Entity\AccountEntity;
use AccountLedger\Entity\LedgerEntity;

/**
 * 
 * @author jaimie
 *
 */
interface AccountServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return AccountEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return AccountEntity
     */
    public function get($id);

    /**
     *
     * @return AccountEntity
     */
    public function getNonSystemAccounts();

    /**
     * 
     * @param number $accountTypeId
     * @return AccountEntity
     */
    public function getAccountsByType($accountTypeId);
    
    /**
     *
     * @param AccountEntity $entity            
     * @return AccountEntity
     */
    public function save(AccountEntity $entity);

    /**
     *
     * @param AccountEntity $entity            
     * @return boolean
     */
    public function delete(AccountEntity $entity);
    
    /**
     * 
     * @param unknown $accountId
     * @param unknown $fromAccountId
     * @param unknown $ledgerAmount
     * @return LedgerEntity
     */
    public function addLedgerCreditItem($accountId, $fromAccountId, $ledgerAmount, $ledgerMemo);
    
    /**
     * 
     * @param unknown $accountId
     * @param unknown $fromAccountId
     * @param unknown $ledgerAmount
     * @return LedgerEntity
     */
    public function addLedgerDebitItem($accountId, $fromAccountId, $ledgerAmount, $ledgerMemo);
}
