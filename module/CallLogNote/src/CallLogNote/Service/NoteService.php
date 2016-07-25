<?php
namespace CallLogNote\Service;

use CallLogNote\Entity\NoteEntity;
use CallLogNote\Mapper\NoteMapperInterface;

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
     * @see \CallLogNote\Service\NoteServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \CallLogNote\Service\NoteServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \CallLogNote\Service\NoteServiceInterface::save()
     */
    public function save(NoteEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \CallLogNote\Service\NoteServiceInterface::delete()
     */
    public function delete(NoteEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    public function getCallLogNotes($callLogId)
    {
        $filter = array(
            'callLogId' => $callLogId
        );
        
        return $this->mapper->getAll($filter);
    }
}