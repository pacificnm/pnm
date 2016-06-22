<?php
namespace Account\Mapper;

use Account\Entity\AccountEntity;

interface AccountMapperInterface
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