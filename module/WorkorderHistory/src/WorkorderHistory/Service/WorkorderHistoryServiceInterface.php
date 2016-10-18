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
     * @param number $workorderId
     * @param number $authId
     * @param string $historyUrl
     * @param string $historyAction
     * @param string $historyNote
     */
    public function create($workorderId, $authId, $historyUrl, $historyAction, $historyNote);
    
    /**
     *
     * @param WorkorderHistoryEntity $entity            
     * @return boolean
     */
    public function delete(WorkorderHistoryEntity $entity);
}

