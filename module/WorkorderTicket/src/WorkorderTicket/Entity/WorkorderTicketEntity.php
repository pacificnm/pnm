<?php
namespace WorkorderTicket\Entity;

class WorkorderTicketEntity
{

    /**
     *
     * @var number
     */
    protected $workorderTicketId;

    /**
     *
     * @var number
     */
    protected $ticketId;

    /**
     *
     * @var number
     */
    protected $workorderId;

    /**
     *
     * @return the $workorderTicketId
     */
    public function getWorkorderTicketId()
    {
        return $this->workorderTicketId;
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
     * @return the $workorderId
     */
    public function getWorkorderId()
    {
        return $this->workorderId;
    }

    /**
     *
     * @param number $workorderTicketId            
     */
    public function setWorkorderTicketId($workorderTicketId)
    {
        $this->workorderTicketId = $workorderTicketId;
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
     * @param number $workorderId            
     */
    public function setWorkorderId($workorderId)
    {
        $this->workorderId = $workorderId;
    }
}

