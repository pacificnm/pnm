<?php
namespace HostAttribute\Service;

use HostAttribute\Entity\AttributeEntity;
interface AttributeServiceInterface
{
    /**
     *
     * @param array $filter
     * @return AttributeEntity
     */
    public function getAll($filter);
    
    /**
     *
     * @param number $id
     * @return AttributeEntity
     */
    public function get($id);
    
    /**
     *
     * @param AttributeEntity $entity
     * @return AttributeEntity
     */
    public function save(AttributeEntity $entity);
    
    /**
     *
     * @param AttributeEntity $entity
     * @return boolean
     */
    public function delete(AttributeEntity $entity);
}