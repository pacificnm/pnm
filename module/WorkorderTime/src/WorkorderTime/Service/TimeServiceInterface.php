<?php
namespace WorkorderTime\Service;

use WorkorderTime\Entity\TimeEntity;

interface TimeServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return TimeEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return TimeEntity
     */
    public function get($id);

    /**
     *
     * @param TimeEntity $entity            
     * @return TimeEntity
     */
    public function save(TimeEntity $entity);

    /**
     *
     * @param TimeEntity $entity            
     * @return boolean
     */
    public function delete(TimeEntity $entity);
}