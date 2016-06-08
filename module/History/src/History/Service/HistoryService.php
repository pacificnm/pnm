<?php
namespace History\Service;

use History\Entity\HistoryEntity;
use History\Mapper\HistoryMapperInterface;

class HistoryService implements HistoryServiceInterface
{

    /**
     * 
     * @var HistoryMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param HistoryMapperInterface $mapper
     */
    public function __construct(HistoryMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \History\Service\HistoryServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \History\Service\HistoryServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \History\Service\HistoryServiceInterface::save()
     */
    public function save(HistoryEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \History\Service\HistoryServiceInterface::delete()
     */
    public function delete(HistoryEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
   
}