<?php
namespace WorkorderNote\Service;

use WorkorderNote\Entity\NoteEntity;
use WorkorderNote\Mapper\NoteMapperInterface;

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
     *
     * @see \WorkorderNote\Service\NoteServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderNote\Service\NoteServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderNote\Service\NoteServiceInterface::save()
     */
    public function save(NoteEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderNote\Service\NoteServiceInterface::delete()
     */
    public function delete(NoteEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    public function getWorkorderNotes($workorderId)
    {
        $filter = array('workorderId' => $workorderId);
        
        return $this->mapper->getAll($filter);
    }
}