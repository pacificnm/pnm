<?php
namespace Task\V1\Rest\TaskReminder;

class TaskReminderResourceFactory
{
    public function __invoke($services)
    {        
        $taskService = $services->get('Task\Service\TaskServiceInterface');
        
        $configService = $services->get('Config\Service\ConfigServiceInterface');
        
        return new TaskReminderResource($taskService, $configService);
    }
}
