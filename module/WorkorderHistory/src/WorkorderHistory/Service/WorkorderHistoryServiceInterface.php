<?php
namespace WorkorderHistory\Service;

use WorkorderHistory\Entity\WorkorderHistoryEntity;

interface WorkorderHistoryServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return WorkorderHistoryEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $workorderId
     * @return WorkorderHistoryEntity
     */
    public function getWorkorderHistory($workorderId);
    
    /**
     *
     * @param number $id            
     * @return WorkorderHistoryEntity
     */
    public function get($id);

    /**
     *
     * @param WorkorderHistoryEntity $entity            
     * @return WorkorderHistoryEntity
     */
    public function save(WorkorderHistoryEntity $entity);

    /**
     *
     * @param WorkorderHistoryEntity $entity            
     * @return boolean
     */
    public function delete(WorkorderHistoryEntity $entity);
}

