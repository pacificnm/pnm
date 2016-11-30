<?php
namespace ProductType\Mapper;

use ProductType\Entity\ProductTypeEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return ProductTypeEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return ProductTypeEntity
     */
    public function get($id);

    /**
     *
     * @param ProductTypeEntity $entity            
     * @return ProductTypeEntity
     */
    public function save(ProductTypeEntity $entity);

    /**
     *
     * @param ProductTypeEntity $entity            
     * @return bool
     */
    public function delete(ProductTypeEntity $entity);
}

