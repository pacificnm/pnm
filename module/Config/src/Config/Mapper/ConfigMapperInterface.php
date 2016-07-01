<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Config\Mapper;

use Config\Entity\ConfigEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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