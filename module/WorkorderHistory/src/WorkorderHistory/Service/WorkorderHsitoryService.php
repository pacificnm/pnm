<?php
namespace WorkorderHistory\Service;

use WorkorderHistory\Entity\WorkorderHistoryEntity;
use WorkorderHistory\Mapper\WorkorderHistoryMapperInterface;
use History\Service\HistoryServiceInterface;
use History\Entity\HistoryEntity;

class WorkorderHsitoryService implements WorkorderHistoryServiceInterface
{
    /**
     * 
     * @var WorkorderHistoryMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @var HistoryServiceInterface
     */
    protected $historyService;
    
    /**
     * 
     * @param WorkorderHistoryMapperInterface $mapper
     * @param HistoryServiceInterface $historyService
     */
    public function __construct(WorkorderHistoryMapperInterface $mapper, HistoryServiceInterface $historyService)
    {
        $this->mapper = $mapper;
        
        $this->historyService = $historyService;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHistory\service\WorkorderHistoryServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHistory\Service\WorkorderHistoryServiceInterface::getWorkorderHistory()
     */
    public function getWorkorderHistory($workorderId)
    {
        return $this->mapper->getWorkorderHistory($workorderId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHistory\service\WorkorderHistoryServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHistory\service\WorkorderHistoryServiceInterface::save()
     */
    public function save(WorkorderHistoryEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    public function create($workorderId, $authId, $historyUrl, $historyAction, $historyNote)
    {
        $entity = new HistoryEntity();
        
        $entity->setAuthId($authId);
        $entity->setHistoryAction($historyAction);
        $entity->setHistoryId(0);
        $entity->setHistoryTime(time());
        $entity->setHistoryUrl($historyUrl);
        $entity->setHistoryNote($historyNote);
        
        $historyEntity = $this->historyService->save($entity);
        
        $entity = new WorkorderHistoryEntity();
        
        $entity->setHistoryId($historyEntity->getHistoryId());
        $entity->setWorkorderId($workorderId);       
        $entity->setWorkorderHistoryId(0);
        
        $workorderHistoryEntity = $this->save($entity);
        
        return $workorderHistoryEntity;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHistory\service\WorkorderHistoryServiceInterface::delete()
     */
    public function delete(WorkorderHistoryEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

