<?php
namespace TicketHistory\Entity;

use Ticket\Entity\TicketEntity;

class TicketHistoryEntity
{

    /**
     *
     * @var number
     */
    protected $ticketHistoryId;

    /**
     *
     * @var number
     */
    protected $historyId;

    /**
     *
     * @var number
     */
    protected $ticketId;

    /**
     *
     * @var TicketEntity
     */
    protected $historyEntity;

    /**
     *
     * @return the $ticketHistoryId
     */
    public function getTicketHistoryId()
    {
        return $this->ticketHistoryId;
    }

    /**
     *
     * @return the $historyId
     */
    public function getHistoryId()
    {
        return $this->historyId;
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
     * @return the $historyEntity
     */
    public function getHistoryEntity()
    {
        return $this->historyEntity;
    }

    /**
     *
     * @param number $ticketHistoryId            
     */
    public function setTicketHistoryId($ticketHistoryId)
    {
        $this->ticketHistoryId = $ticketHistoryId;
    }

    /**
     *
     * @param number $historyId            
     */
    public function setHistoryId($historyId)
    {
        $this->historyId = $historyId;
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
     * @param \Ticket\Entity\TicketEntity $historyEntity            
     */
    public function setHistoryEntity($historyEntity)
    {
        $this->historyEntity = $historyEntity;
    }
}