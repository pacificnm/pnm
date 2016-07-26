<?php
namespace WorkorderHistory\Service;

use WorkorderHistory\Entity\WorkorderHistoryEntity;
use WorkorderHistory\Mapper\WorkorderHistoryMapperInterface;

class WorkorderHsitoryService implements WorkorderHistoryServiceInterface
{
    /**
     * 
     * @var WorkorderHistoryMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param WorkorderHistoryMapperInterface $mapper
     */
    public function __construct(WorkorderHistoryMapperInterface $mapper)
    {
        $this->mapper = $mapper;
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

