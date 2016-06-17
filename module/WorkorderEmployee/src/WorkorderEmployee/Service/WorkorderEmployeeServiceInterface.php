<?php
namespace WorkorderEmployee\Service;

use WorkorderEmployee\Entity\WorkorderEmployeeEntity;

interface WorkorderEmployeeServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return WorkorderEmployeeEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return WorkorderEmployeeEntity
     */
    public function get($id);

    /**
     *
     * @param WorkorderEmployeeEntity $entity            
     * @return WorkorderEmployeeEntity
     */
    public function save(WorkorderEmployeeEntity $entity);

    /**
     *
     * @param WorkorderEmployeeEntity $entity            
     * @return boolean
     */
    public function delete(WorkorderEmployeeEntity $entity);
    
    /**
     *
     * @param number $employeeId
     * @param string $status
     * @return WorkorderEmployeeEntity
     */
    public function getEmployeeWorkorders($employeeId, $status = 'Active');
} 