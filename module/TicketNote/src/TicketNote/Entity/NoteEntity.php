<?php
namespace TicketNote\Entity;

use Auth\Entity\AuthEntity;
use Ticket\Entity\TicketEntity;

class NoteEntity
{

    /**
     *
     * @var number
     */
    protected $ticketNoteId;

    /**
     *
     * @var number
     */
    protected $ticketId;

    /**
     *
     * @var number
     */
    protected $authId;

    /**
     *
     * @var bool
     */
    protected $ticketNoteClientView;

    /**
     *
     * @var number
     */
    protected $ticketNoteDateCreate;

    /**
     *
     * @var string
     */
    protected $ticketNoteText;

    /**
     *
     * @var AuthEntity
     */
    protected $authEntity;

    /**
     *
     * @var TicketEntity
     */
    protected $ticketEntity;

    /**
     *
     * @return the $ticketNoteId
     */
    public function getTicketNoteId()
    {
        return $this->ticketNoteId;
    }

    /**
     *
     * @return the $ticketId
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     *
     * @return the $authId
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     *
     * @return the $ticketNoteClientView
     */
    public function getTicketNoteClientView()
    {
        return $this->ticketNoteClientView;
    }

    /**
     *
     * @return the $ticketNoteDateCreate
     */
    public function getTicketNoteDateCreate()
    {
        return $this->ticketNoteDateCreate;
    }

    /**
     *
     * @return the $ticketNoteText
     */
    public function getTicketNoteText()
    {
        return $this->ticketNoteText;
    }

    /**
     *
     * @return the $authEntity
     */
    public function getAuthEntity()
    {
        return $this->authEntity;
    }

    /**
     *
     * @return the $ticketEntity
     */
    public function getTicketEntity()
    {
        return $this->ticketEntity;
    }

    /**
     *
     * @param number $ticketNoteId            
     */
    public function setTicketNoteId($ticketNoteId)
    {
        $this->ticketNoteId = $ticketNoteId;
    }

    /**
     *
     * @param number $ticketId            
     */
    public function setTicketId($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    /**
     *
     * @param number $authId            
     */
    public function setAuthId($authId)
    {
        $this->authId = $authId;
    }

    /**
     *
     * @param boolean $ticketNoteClientView            
     */
    public function setTicketNoteClientView($ticketNoteClientView)
    {
        $this->ticketNoteClientView = $ticketNoteClientView;
    }

    /**
     *
     * @param number $ticketNoteDateCreate            
     */
    public function setTicketNoteDateCreate($ticketNoteDateCreate)
    {
        $this->ticketNoteDateCreate = $ticketNoteDateCreate;
    }

    /**
     *
     * @param string $ticketNoteText            
     */
    public function setTicketNoteText($ticketNoteText)
    {
        $this->ticketNoteText = $ticketNoteText;
    }

    /**
     *
     * @param \Auth\Entity\AuthEntity $authEntity            
     */
    public function setAuthEntity($authEntity)
    {
        $this->authEntity = $authEntity;
    }

    /**
     *
     * @param \Ticket\Entity\TicketEntity $ticketEntity            
     */
    public function setTicketEntity($ticketEntity)
    {
        $this->ticketEntity = $ticketEntity;
    }
}

