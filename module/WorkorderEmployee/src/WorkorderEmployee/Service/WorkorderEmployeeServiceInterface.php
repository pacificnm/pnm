<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace WorkorderEmployee\Service;

use WorkorderEmployee\Entity\WorkorderEmployeeEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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
    
    /**
     *
     * @param number $employeeId
     * @param number $workorderId
     * @return WorkorderEmployeeEntity
     */
    public function getEmployeeWorkorder($employeeId, $workorderId);
} 