<?php
namespace Vendor\Service;

use Vendor\Entity\VendorEntity;

interface VendorServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return VendorEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return VendorEntity
     */
    public function get($id);

    /**
     *
     * @param VendorEntity $entity            
     * @return VendorEntity
     */
    public function save(VendorEntity $entity);

    /**
     *
     * @param VendorEntity $entity            
     * @return boolean
     */
    public function delete(VendorEntity $entity);
}