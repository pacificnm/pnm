<?php
namespace Ticket\Entity;

use User\Entity\UserEntity;

class TicketEntity
{

    /**
     *
     * @var number
     */
    protected $ticketId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $userId;

    /**
     *
     * @var string
     */
    protected $ticketTitle;

    /**
     *
     * @var string
     */
    protected $ticketStatus;

    /**
     *
     * @var number
     */
    protected $ticketDateOpen;

    /**
     *
     * @var number
     */
    protected $ticketDateClose;

    /**
     *
     * @var string
     */
    protected $ticketText;

    /**
     *
     * @var UserEntity
     */
    protected $userEntity;

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
     * @return the $clientId
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     *
     * @return the $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     *
     * @return the $ticketTitle
     */
    public function getTicketTitle()
    {
        return $this->ticketTitle;
    }

    /**
     *
     * @return the $ticketStatus
     */
    public function getTicketStatus()
    {
        return $this->ticketStatus;
    }

    /**
     *
     * @return the $ticketDateOpen
     */
    public function getTicketDateOpen()
    {
        return $this->ticketDateOpen;
    }

    /**
     *
     * @return the $ticketDateClose
     */
    public function getTicketDateClose()
    {
        return $this->ticketDateClose;
    }

    /**
     *
     * @return the $ticketText
     */
    public function getTicketText()
    {
        return $this->ticketText;
    }

    /**
     *
     * @return the $userEntity
     */
    public function getUserEntity()
    {
        return $this->userEntity;
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
     * @param number $clientId            
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     *
     * @param number $userId            
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     *
     * @param string $ticketTitle            
     */
    public function setTicketTitle($ticketTitle)
    {
        $this->ticketTitle = $ticketTitle;
    }

    /**
     *
     * @param string $ticketStatus            
     */
    public function setTicketStatus($ticketStatus)
    {
        $this->ticketStatus = $ticketStatus;
    }

    /**
     *
     * @param number $ticketDateOpen            
     */
    public function setTicketDateOpen($ticketDateOpen)
    {
        $this->ticketDateOpen = $ticketDateOpen;
    }

    /**
     *
     * @param number $ticketDateClose            
     */
    public function setTicketDateClose($ticketDateClose)
    {
        $this->ticketDateClose = $ticketDateClose;
    }

    /**
     *
     * @param string $ticketText            
     */
    public function setTicketText($ticketText)
    {
        $this->ticketText = $ticketText;
    }

    /**
     *
     * @param \User\Entity\UserEntity $userEntity            
     */
    public function setUserEntity($userEntity)
    {
        $this->userEntity = $userEntity;
    }
}

