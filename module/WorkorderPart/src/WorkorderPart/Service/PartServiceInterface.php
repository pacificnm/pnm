<?php
namespace WorkorderPart\Service;

use WorkorderPart\Entity\PartEntity;

interface PartServiceInterface
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
     * @param number $workorderId            
     * @return PartEntity
     */
    public function getWorkorderParts($workorderId);

    /**
     *
     * @param number $start            
     * @param number $end            
     */
    public function getTotalByDateRange($start, $end);
}
