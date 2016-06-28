<?php
namespace HostAttributeValue\Mapper;

use HostAttributeValue\Entity\ValueEntity;

interface ValueMapperInterface
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
     * @param string $value
     * @return ValueEntity
     */
    public function getValue($value);
    
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
}