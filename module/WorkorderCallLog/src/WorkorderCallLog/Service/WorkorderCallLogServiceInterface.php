<?php
namespace WorkorderCallLog\Service;

use WorkorderCallLog\Entity\WorkorderCallLogEntity;

interface WorkorderCallLogServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return WorkorderCallLogEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return WorkorderCallLogEntity
     */
    public function get($id);

    /**
     *
     * @param number $callLogId
     * @return WorkorderCallLogEntity
     */
    public function getCallLogWorkorders($callLogId);
    
    /**
     *
     * @param WorkorderCallLogEntity $entity            
     * @return WorkorderCallLogEntity
     */
    public function save(WorkorderCallLogEntity $entity);

    /**
     *
     * @param WorkorderCallLogEntity $entity            
     * @return bool
     */
    public function delete(WorkorderCallLogEntity $entity);
}