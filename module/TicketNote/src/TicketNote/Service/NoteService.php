<?php
namespace TicketNote\Service;

use TicketNote\Mapper\MysqlMapperInterface;
use TicketNote\Entity\NoteEntity;

class NoteService implements NoteServiceInterface
{
    /**
     * 
     * @var MysqlMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param MysqlMapperInterface $mapper
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TicketNote\Service\NoteServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TicketNote\Service\NoteServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TicketNote\Service\NoteServiceInterface::getTicketNotes()
     */
    public function getTicketNotes($ticketId)
    {
     
        $filter = array(
            'ticketId' => $ticketId
        );
        
        return $this->mapper->getAll($filter);    
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \TicketNote\Service\NoteServiceInterface::save()
     */
    public function save(NoteEntity $entity)
    {
        $noteEntity = $this->mapper->save($entity);
        
        return $this->get($noteEntity->getTicketNoteId());
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TicketNote\Service\NoteServiceInterface::delete()
     */
    public function delete(NoteEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

