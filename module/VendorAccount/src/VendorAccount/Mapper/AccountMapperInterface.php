<?php
namespace VendorAccount\Mapper;

use VendorAccount\Entity\AccountEntity;

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
     * @param number $vendorId
     * @return AccountEntity
     */
    public function getVendorAccount($vendorId);
    
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