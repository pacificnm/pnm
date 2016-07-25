<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace CallLog\Mapper;

use CallLog\Entity\LogEntity;

interface LogMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return LogEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return LogEntity
     */
    public function get($id);

    /**
     * 
     * @param number $employeeId
     * @return LogEntity
     */
    public function getEmployeeCallLogs($employeeId);
    
    /**
     *
     * @param LogEntity $entity            
     * @return LogEntity
     */
    public function save(LogEntity $entity);

    /**
     *
     * @param LogEntity $entity            
     * @return boolean
     */
    public function delete(LogEntity $entity);
}