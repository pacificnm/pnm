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
    
}
