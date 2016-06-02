<?php
namespace Config\Service;

use Config\Entity\ConfigEntity;

interface ConfigServiceInterface
{
    /**
     *
     * @param array $filter
     * @return ConfigEntity
     */
    public function getAll($filter);
    
    /**
     *
     * @param number $id
     * @return ConfigEntity
     */
    public function get($id);
    
    /**
     *
     * @param ConfigEntity $entity
     * @return ConfigEntity
     */
    public function save(ConfigEntity $entity);
    
    /**
     *
     * @param ConfigEntity $entity
     * @return boolean
     */
    public function delete(ConfigEntity $entity);
}