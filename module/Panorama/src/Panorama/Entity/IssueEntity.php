<?php
namespace Panorama\Entity;

use Zend\Db\Sql\Ddl\Column\Boolean;

class IssueEntity
{

    /**
     *
     * @var number
     */
    protected $issueId;

    /**
     *
     * @var string
     */
    protected $area;

    /**
     *
     * @var string
     */
    protected $category;

    /**
     *
     * @var string
     */
    protected $type;

    /**
     *
     * @var string
     */
    protected $message;

    /**
     *
     * @var string
     */
    protected $firstSeen;

    /**
     *
     * @var string
     */
    protected $lastSeen;

    /**
     *
     * @var Boolean
     */
    protected $resolved;

    /**
     *
     * @var string
     */
    protected $resolvedTime;

    /**
     *
     * @var Boolean
     */
    protected $snoozed;

    /**
     *
     * @var number
     */
    protected $zendeskId;

    /**
     *
     * @var number
     */
    protected $deskTicketId;

    /**
     *
     * @var number
     */
    protected $autotaskTicketId;

    /**
     *
     * @var number
     */
    protected $itemId;

    /**
     *
     * @var string
     */
    protected $vulnerability;

    /**
     *
     * @var string
     */
    protected $device_id;

    /**
     *
     * @return the $issueId
     */
    public function getIssueId()
    {
        return $this->issueId;
    }

    /**
     *
     * @return the $area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     *
     * @return the $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     *
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @return the $message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     *
     * @return the $firstSeen
     */
    public function getFirstSeen()
    {
        return $this->firstSeen;
    }

    /**
     *
     * @return the $lastSeen
     */
    public function getLastSeen()
    {
        return $this->lastSeen;
    }

    /**
     *
     * @return the $resolved
     */
    public function getResolved()
    {
        return $this->resolved;
    }

    /**
     *
     * @return the $resolvedTime
     */
    public function getResolvedTime()
    {
        return $this->resolvedTime;
    }

    /**
     *
     * @return the $snoozed
     */
    public function getSnoozed()
    {
        return $this->snoozed;
    }

    /**
     *
     * @return the $zendeskId
     */
    public function getZendeskId()
    {
        return $this->zendeskId;
    }

    /**
     *
     * @return the $deskTicketId
     */
    public function getDeskTicketId()
    {
        return $this->deskTicketId;
    }

    /**
     *
     * @return the $autotaskTicketId
     */
    public function getAutotaskTicketId()
    {
        return $this->autotaskTicketId;
    }

    /**
     *
     * @return the $itemId
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     *
     * @return the $vulnerability
     */
    public function getVulnerability()
    {
        return $this->vulnerability;
    }

    /**
     *
     * @return the $device_id
     */
    public function getDevice_id()
    {
        return $this->device_id;
    }

    /**
     *
     * @param number $issueId            
     */
    public function setIssueId($issueId)
    {
        $this->issueId = $issueId;
    }

    /**
     *
     * @param string $area            
     */
    public function setArea($area)
    {
        $this->area = $area;
    }

    /**
     *
     * @param string $category            
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     *
     * @param string $type            
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     *
     * @param string $message            
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     *
     * @param string $firstSeen            
     */
    public function setFirstSeen($firstSeen)
    {
        $this->firstSeen = $firstSeen;
    }

    /**
     *
     * @param string $lastSeen            
     */
    public function setLastSeen($lastSeen)
    {
        $this->lastSeen = $lastSeen;
    }

    /**
     *
     * @param \Zend\Db\Sql\Ddl\Column\Boolean $resolved            
     */
    public function setResolved($resolved)
    {
        $this->resolved = $resolved;
    }

    /**
     *
     * @param string $resolvedTime            
     */
    public function setResolvedTime($resolvedTime)
    {
        $this->resolvedTime = $resolvedTime;
    }

    /**
     *
     * @param \Zend\Db\Sql\Ddl\Column\Boolean $snoozed            
     */
    public function setSnoozed($snoozed)
    {
        $this->snoozed = $snoozed;
    }

    /**
     *
     * @param number $zendeskId            
     */
    public function setZendeskId($zendeskId)
    {
        $this->zendeskId = $zendeskId;
    }

    /**
     *
     * @param number $deskTicketId            
     */
    public function setDeskTicketId($deskTicketId)
    {
        $this->deskTicketId = $deskTicketId;
    }

    /**
     *
     * @param number $autotaskTicketId            
     */
    public function setAutotaskTicketId($autotaskTicketId)
    {
        $this->autotaskTicketId = $autotaskTicketId;
    }

    /**
     *
     * @param number $itemId            
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     *
     * @param string $vulnerability            
     */
    public function setVulnerability($vulnerability)
    {
        $this->vulnerability = $vulnerability;
    }

    /**
     *
     * @param string $device_id            
     */
    public function setDevice_id($device_id)
    {
        $this->device_id = $device_id;
    }
}