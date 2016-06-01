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
     * @param TaskEntity $taskEntity            
     * @return TaskEntity
     */
    public function save(TaskEntity $taskEntity);

    /**
     *
     * @param TaskEntity $taskEntity            
     * @return boolean
     */
    public function delete(TaskEntity $taskEntity);
}
