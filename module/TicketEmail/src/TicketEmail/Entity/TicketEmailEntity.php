<?php
namespace TicketEmail\Entity;

use Email\Entity\EmailEntity;

class TicketEmailEntity
{

    /**
     *
     * @var number
     */
    protected $ticketEmailId;

    /**
     *
     * @var number
     */
    protected $emailId;

    /**
     *
     * @var number
     */
    protected $ticketId;

    /**
     *
     * @var EmailEntity
     */
    protected $emailEntity;

    /**
     *
     * @return the $ticketEmailId
     */
    public function getTicketEmailId()
    {
        return $this->ticketEmailId;
    }

    /**
     *
     * @return the $emailId
     */
    public function getEmailId()
    {
        return $this->emailId;
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
     * @return the $emailEntity
     */
    public function getEmailEntity()
    {
        return $this->emailEntity;
    }

    /**
     *
     * @param number $ticketEmailId            
     */
    public function setTicketEmailId($ticketEmailId)
    {
        $this->ticketEmailId = $ticketEmailId;
    }

    /**
     *
     * @param number $emailId            
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;
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
     * @param \Email\Entity\EmailEntity $emailEntity            
     */
    public function setEmailEntity($emailEntity)
    {
        $this->emailEntity = $emailEntity;
    }
}