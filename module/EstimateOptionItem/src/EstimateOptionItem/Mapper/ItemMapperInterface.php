<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace EstimateOptionItem\Mapper;

use EstimateOptionItem\Entity\ItemEntity;

interface ItemMapperInterface
{
    /**
     *
     * @param array $filter
     * @return ItemEntity
     */
    public function getAll($filter);
    
    /**
     *
     * @param number $id
     * @return ItemEntity
     */
    public function get($id);
    
    /**
     *
     * @param ItemEntity $entity
     * @return ItemEntity
     */
    public function save(ItemEntity $entity);
    
    /**
     *
     * @param ItemEntity $entity
     * @return boolean
     */
    public function delete(ItemEntity $entity);
}