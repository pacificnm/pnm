<?php
namespace CallLog\V1\Rest\CallLog;

use Zend\ServiceManager\ServiceLocatorInterface;

class CallLogResourceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $services            
     * @return \CallLog\V1\Rest\CallLog\CallLogResource
     */
    public function __invoke(ServiceLocatorInterface $services)
    {
        $clientService = $services->get('Client\Service\ClientServiceInterface');
        
        $logService = $services->get('CallLog\Service\LogServiceInterface');
        
        $notificationService = $services->get('Notification\Service\NotificationServiceInterface');
        
        return new CallLogResource($clientService, $logService, $notificationService);
    }
}
