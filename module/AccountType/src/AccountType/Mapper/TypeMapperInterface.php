<?php
namespace AccountType\Mapper;

use AccountType\Entity\TypeEntity;

interface TypeMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return TypeEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return TypeEntity
     */
    public function get($id);

    /**
     *
     * @param TypeEntity $entity            
     * @return TypeEntity
     */
    public function save(TypeEntity $entity);

    /**
     *
     * @param TypeEntity $entity            
     * @return boolean
     */
    public function delete(TypeEntity $entity);
}
