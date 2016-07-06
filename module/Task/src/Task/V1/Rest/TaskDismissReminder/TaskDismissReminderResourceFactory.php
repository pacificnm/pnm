<?php
namespace Task\V1\Rest\TaskDismissReminder;

class TaskDismissReminderResourceFactory
{
    public function __invoke($services)
    {
        $taskService = $services->get('Task\Service\TaskServiceInterface');
        
        return new TaskDismissReminderResource($taskService);
    }
}
