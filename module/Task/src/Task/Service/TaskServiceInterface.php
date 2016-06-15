<?php
namespace Task\Service;

use Task\Entity\TaskEntity;

interface TaskServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return TaskEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return TaskEntity
     */
    public function get($id);

    /**
     *
     * @param number $employeeId
     * @return TaskEntity
     */
    public function getEmployeeReminders($employeeId);
    
    /**
     *
     * @param TaskEntity $entity            
     * @return TaskEntity
     */
    public function save(TaskEntity $entity);

    /**
     *
     * @param TaskEntity $entity            
     * @return boolean
     */
    public function delete(TaskEntity $entity);

    /**
     *
     * @param number $clientId            
     * @return TaskEntity
     */
    public function getClientActiveTasks($clientId);

    /**
     *
     * @param number $employeeId            
     * @return TaskEntity
     */
    public function getEmployeeActiveTasks($employeeId);
}
