<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace AccountLedger\Service;

use AccountLedger\Entity\LedgerEntity;

/**
 * 
 * @author jaimie
 *
 */
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
