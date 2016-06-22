<?php
namespace ClientAccount\Service;

use ClientAccount\Entity\AccountEntity;

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
     * @param number $clientId
     * @return AccountEntity
     */
    public function getClientAccount($clientId);
    
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
