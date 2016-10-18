<?php
namespace CallLog\Mapper;

use CallLog\Entity\LogEntity;

interface MysqlMapperInterface
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
