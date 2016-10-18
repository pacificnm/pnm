<?php
namespace TicketEmail\Service;

use TicketEmail\Entity\TicketEmailEntity;
use Ticket\Entity\TicketEntity;
use TicketNote\Entity\NoteEntity;

interface TicketEmailServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return TicketEmailEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return TicketEmailEntity
     */
    public function get($id);

    /**
     *
     * @param TicketEmailEntity $entity            
     * @return TicketEmailEntity
     */
    public function save(TicketEmailEntity $entity);

    /**
     *
     * @param TicketEmailEntity $entity            
     * @return TicketEmailEntity
     */
    public function delete(TicketEmailEntity $entity);

    /**
     *
     * @param TicketEntity $ticketEntity            
     * @return TicketEmailEntity
     */
    public function sendTicketCreate(TicketEntity $ticketEntity);

    /**
     *
     * @param TicketEntity $ticketEntity            
     * @return TicketEmailEntity
     */
    public function sendTicketClose(TicketEntity $ticketEntity);

    /**
     * 
     * @param TicketEntity $ticketEntity
     * @param NoteEntity $noteEntity
     */
    public function sendTicketNote(TicketEntity $ticketEntity, NoteEntity $noteEntity);
    
    /**
     * 
     * @param TicketEntity $ticketEntity
     * @param NoteEntity $noteEntity
     */
    public function sendTicketNoteUpdate(TicketEntity $ticketEntity, NoteEntity $noteEntity);
    
    /**
     *
     * @param number $emailId            
     * @param number $ticketId            
     * @return TicketEmailEntity
     */
    public function mapEmail($emailId, $ticketId);
}