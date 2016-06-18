<?php
namespace HostAttributeValue\Service;

use HostAttributeValue\Entity\ValueEntity;

interface ValueServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return ValueEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return ValueEntity
     */
    public function get($id);

    /**
     *
     * @param ValueEntity $entity            
     * @return ValueEntity
     */
    public function save(ValueEntity $entity);

    /**
     *
     * @param ValueEntity $entity            
     * @return boolean
     */
    public function delete(ValueEntity $entity);
    
    /**
     * 
     * @param number $attributeId
     * @return ValueEntity
     */
    public function getAttributeValues($attributeId);
}
