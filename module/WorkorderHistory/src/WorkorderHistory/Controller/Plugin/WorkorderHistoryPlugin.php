<?php
namespace WorkorderHistory\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use History\Entity\HistoryEntity;
use WorkorderHistory\Entity\WorkorderHistoryEntity;
use History\Service\HistoryServiceInterface;
use WorkorderHistory\service\WorkorderHistoryServiceInterface;

class WorkorderHistoryPlugin extends AbstractPlugin
{
    /**
     *
     * @var HistoryServiceInterface
     */
    protected $historyService;
    
    /**
     * 
     * @var WorkorderHistoryServiceInterface
     */
    protected $workorderHistoryService;
    
    /**
     * 
     * @param HistoryServiceInterface $historyService
     * @param WorkorderHistoryServiceInterface $workorderHistoryService
     */
    public function __construct(HistoryServiceInterface $historyService, WorkorderHistoryServiceInterface $workorderHistoryService)
    {
        $this->historyService = $historyService;
        
        $this->workorderHistoryService = $workorderHistoryService;
    }
    
    /**
     * Saves history and maps it to the work order
     * @param string $uri 
     * @param string $action
     * @param number $authId
     * @param string $note
     * @param number $workorderId
     * @return \WorkorderHistory\Entity\WorkorderHistoryEntity
     */
    public function __invoke($uri, $action, $authId, $note, $workorderId)
    {
        $entity = new HistoryEntity();
        
        $entity->setAuthId($authId);
        $entity->setHistoryAction($action);
        $entity->setHistoryNote($note);
        $entity->setHistoryTime(time());
        $entity->setHistoryUrl($uri);
        
        $historyEntity = $this->historyService->save($entity);
        
        
        $entity = new WorkorderHistoryEntity();
        
        $entity->setHistoryId($historyEntity->getHistoryId());
        $entity->setWorkorderId($workorderId);
        
        $workorderHistoryEntity = $this->workorderHistoryService->save($entity);
        
        
        return $workorderHistoryEntity;
    }
}

