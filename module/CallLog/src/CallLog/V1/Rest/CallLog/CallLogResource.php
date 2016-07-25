<?php
namespace CallLog\V1\Rest\CallLog;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Client\Service\ClientServiceInterface;
use CallLog\Service\LogServiceInterface;
use Notification\Service\NotificationServiceInterface;
use Notification\Entity\NotificationEntity;
use CallLog\Hydrator\LogHydrator;
use CallLog\Entity\LogEntity;

class CallLogResource extends AbstractResourceListener
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var LogServiceInterface
     */
    protected $logService;

    /**
     *
     * @var NotificationServiceInterface
     */
    protected $notificationService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param LogServiceInterface $logService            
     * @param NotificationServiceInterface $notificationService            
     */
    public function __construct(ClientServiceInterface $clientService, LogServiceInterface $logService, NotificationServiceInterface $notificationService)
    {
        $this->clientService = $clientService;
        
        $this->logService = $logService;
        
        $this->notificationService = $notificationService;
    }

    /**
     * Create a resource
     *
     * @param mixed $data            
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $hydrator = new LogHydrator();
        
        $entity = $hydrator->hydrate($data, new LogEntity());
        
        $logEntity = $this->logService->save($entity);
        
        if($logEntity->getEmployeeId() != $this->identity()->getEmployeeId()) {
            
            $clientEntity = $this->clientService->get($logEntity->getClientId());
            
            $notificationEntity = new NotificationEntity();
            
            $url = $this->url()->fromRoute('call-log-view', array('clientId' => $logEntity->getClientId(), 'callLogId' => $logEntity->getCallLogId()));
            
            $notificationText = 'New call log from client ' . $clientEntity->getClientName() . '. <a href="'.$url.'" title="View this call log">View Call Log</a>';
            
            $notificationEntity->setEmployeeId($logEntity->getEmployeeId());
            $notificationEntity->setNotificationDate(time());
            $notificationEntity->setNotificationId(0);
            $notificationEntity->setNotificationStatus('Active');
            $notificationEntity->setNotificationText($notificationText);
            
            $this->notificationService->save($notificationEntity);
        }
       
        
        return $logEntity;
    }

    /**
     * Delete a resource
     *
     * @param mixed $id            
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $entity = $this->logService->get($id);
        
        return $this->logService->delete($entity);
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
        $logEntity = $this->logService->get($id);
        
        return $logEntity;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param array $params            
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        $logEntitys = $this->logService->getAll($params);
        
        return $logEntitys;
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
        $hydrator = new LogHydrator();
        
        $entity = $hydrator->hydrate($data, new LogEntity());
        
        $entity->setCallLogId($id);
        
        $logEntity = $this->logService->save($entity);
        
        return $logEntity;
    }
}
