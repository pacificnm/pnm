<?php
namespace Labor\Mapper;

use Labor\Entity\LaborEntity;

interface LaborMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return LaborEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return LaborEntity
     */
    public function get($id);

    /**
     *
     * @param LaborEntity $entity            
     * @return LaborEntity
     */
    public function save(LaborEntity $entity);

    /**
     *
     * @param LaborEntity $entity            
     * @return boolean
     */
    public function delete(LaborEntity $entity);
}