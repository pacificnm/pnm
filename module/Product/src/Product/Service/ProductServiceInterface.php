<?php
namespace Product\Service;

use Product\Entity\ProductEntity;

interface ProductServiceInterface
{

    /**
     *
     * @param unknown $filter            
     * @return ProductEntity
     */
    public function getAll($filter);

    /**
     *
     * @param unknown $id            
     * @return ProductEntity
     */
    public function get($id);

    /**
     *
     * @param ProductEntity $entity            
     * @return ProductEntity
     */
    public function save(ProductEntity $entity);

    /**
     *
     * @param ProductEntity $entity            
     * @return boolean
     */
    public function delete(ProductEntity $entity);
}