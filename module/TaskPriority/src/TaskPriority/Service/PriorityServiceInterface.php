<?php
namespace TaskPriority\Service;

use TaskPriority\Entity\PriorityEntity;

interface PriorityServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return PriorityEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PriorityEntity
     */
    public function get($id);

    /**
     *
     * @param PriorityEntity $entity            
     * @return PriorityEntity
     */
    public function save(PriorityEntity $entity);

    /**
     *
     * @param PriorityEntity $entity            
     * @return boolean
     */
    public function delete(PriorityEntity $entity);
}