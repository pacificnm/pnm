<?php
namespace TaskNote\Service;

use TaskNote\Entity\NoteEntity;
use TaskNote\Mapper\NoteMapperInterface;

class NoteService implements NoteServiceInterface
{
    /**
     * 
     * @var NoteMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param NoteMapperInterface $mapper
     */
    public function __construct(NoteMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TaskNote\Service\NoteServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TaskNote\Service\NoteServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TaskNote\Service\NoteServiceInterface::save()
     */
    public function save(NoteEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TaskNote\Service\NoteServiceInterface::delete()
     */
    public function delete(NoteEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \TaskNote\Service\NoteServiceInterface::getTaskNotes()
     */
    public function getTaskNotes($taskId)
    {
        $filter = array(
            'taskId' => $taskId
        );
        
        return $this->mapper->getAll($filter);
    }
}