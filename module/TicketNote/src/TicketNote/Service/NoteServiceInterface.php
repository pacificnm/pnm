<?php
namespace TicketNote\Service;



use TicketNote\Entity\NoteEntity;

interface NoteServiceInterface
{
    /**
     *
     * @param array $filter
     * @return NoteEntity
     */
    public function getAll($filter);
    
    /**
     *
     * @param number $id
     * @return NoteEntity
     */
    public function get($id);
    
    /**
     * 
     * @param number $ticketId
     * @return NoteEntity
     */
    public function getTicketNotes($ticketId);
    
    /**
     *
     * @param NoteEntity $entity
     * @return NoteEntity
     */
    public function save(NoteEntity $entity);
    
    /**
     *
     * @param NoteEntity $entity
     * @return boolean
     */
    public function delete(NoteEntity $entity);
}

