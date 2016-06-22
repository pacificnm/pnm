<?php
namespace Account\Service;

use Account\Entity\AccountEntity;

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
}
