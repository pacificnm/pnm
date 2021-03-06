<?php
namespace WorkorderPart\Mapper;

use WorkorderPart\Entity\PartEntity;

interface PartMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return PartEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PartEntity
     */
    public function get($id);

    /**
     *
     * @param PartEntity $entity            
     * @return PartEntity
     */
    public function save(PartEntity $entity);

    /**
     *
     * @param PartEntity $entity            
     * @return boolean
     */
    public function delete(PartEntity $entity);
    
    /**
     * 
     * @param number $start
     * @param number $end
     */
    public function getTotalByDateRange($start, $end);
}