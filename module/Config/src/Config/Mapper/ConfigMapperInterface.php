<?php
namespace Config\Mapper;

use Config\Entity\ConfigEntity;

interface ConfigMapperInterface
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
     * @param ConfigEntity $configEntity
     * @return ConfigEntity
     */
    public function save(ConfigEntity $configEntity);
    
    /**
     *
     * @param ConfigEntity $configEntity
     * @return boolean
     */
    public function delete(ConfigEntity $configEntity);
}