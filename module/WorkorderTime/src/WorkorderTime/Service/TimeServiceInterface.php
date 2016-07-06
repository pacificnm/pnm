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

    /**
     *
     * @param number $workorderId            
     * @return TimeEntity
     */
    public function getWorkorderTimes($workorderId);
    
    /**
     * 
     * @param number $clientId
     * @return TimeEntity
     */
    public function getTotalByLabor($clientId);
    
    /**
     *
     * @param number $employeeId
     * @param number $start
     * @param number $end
     */
    public function getEmployeeTime($employeeId, $start = null, $end = null);
    
    /**
     *
     * @param number $employeeId
     * @param number $start
     * @param number $end
     */
    public function getEmployeeTotalTime($employeeId, $start = null, $end = null);
    
    /**
     * 
     * @param number $start
     * @param number $end
     */
    public function getTotalByDateRange($start, $end);
    
    /**
     *
     * @param number $start
     * @param number $end
     */
    public function getTotalsForMonth($start, $end);
    
    /**
     *
     * @param number $start
     * @param number $end
     */
    public function getTotalsForYear($start, $end, $clientId);
}