<?php
namespace Task\V1\Rest\TaskReminder;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Task\Service\TaskServiceInterface;
use Config\Service\ConfigServiceInterface;

class TaskReminderResource extends AbstractResourceListener
{

    /**
     *
     * @var TaskServiceInterface
     */
    protected $taskService;

    /**
     * 
     * @var ConfigServiceInterface
     */
    protected $configService;

    /**
     * 
     * @param TaskServiceInterface $taskService
     * @param ConfigServiceInterface $configService
     */
    public function __construct(TaskServiceInterface $taskService, ConfigServiceInterface $configService)
    {
        $this->taskService = $taskService;
        
        $this->configService = $configService;
    }

    /**
     * Create a resource
     *
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param mixed $id            
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param mixed $id            
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param array $params            
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        $identity = $this->getIdentity()->getRoleId();
        
        $taskEntitys = $this->taskService->getEmployeeReminders(1);
        
        $configEntity = $this->configService->get($identity);
        
        $data = array();
        
        foreach ($taskEntitys as $taskEntity) {
            $data[] = array(
                'taskId' => $taskEntity->getTaskId(),
                'clientId' => $taskEntity->getClientId(),
                'employeeId' => $taskEntity->getEmployeeId(),
                'clientName' => $taskEntity->getClientEntity()->getClientName(),
                'taskTitle' => $taskEntity->getTaskTitle(),
                'taskDateEnd' => date($configEntity->getConfigDateLong(), $taskEntity->getTaskDateEnd()),
                'taskStatus' => $taskEntity->getTaskStatus(),
                'taskPriority' => $taskEntity->getPriorityEntity()->getTaskPriorityValue()
            );
        }
        
        return $data;
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param mixed $id            
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param mixed $id            
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
