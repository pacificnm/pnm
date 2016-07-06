<?php
namespace WorkorderTime\Mapper;

use WorkorderTime\Entity\TimeEntity;
interface TimeMapperInterface
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
     * @param unknown $clientId
     * @return TimeEntity
     */
    public function getTotalByLabor($clientId);
    
    /**
     * 
     * @param number $employeeId
     * @param number $start
     * @param number $end
     */
    public function getEmployeeTime($employeeId, $start, $end);
    
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
     * @param number $month
     */
    public function getTotalsForMonth($start, $end);
}