<?php
namespace PanoramaIssue\Entity;

class PanoramaIssueEntity
{

    /**
     *
     * @var string
     */
    protected $panoramaIssueId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var string
     */
    protected $panoramaIssueArea;

    /**
     *
     * @var string
     */
    protected $panoramaIssueCategory;

    /**
     *
     * @var string
     */
    protected $panoramaIssueType;

    /**
     *
     * @var string
     */
    protected $panoramaIssueMessage;

    /**
     *
     * @var number
     */
    protected $panoramaIssueFirstSeen;

    /**
     *
     * @var number
     */
    protected $panoramaIssueLastSeen;

    /**
     *
     * @var number
     */
    protected $panoramaIssueResolved;

    /**
     *
     * @var number
     */
    protected $panoramaIssueResolvedTime;

    /**
     *
     * @var number
     */
    protected $panoramaIssueSnoozed;

    /**
     *
     * @var string
     */
    protected $panoramaIssueItemId;

    /**
     *
     * @var string
     */
    protected $panoramaIssueVulnerability;

    /**
     *
     * @return the $panoramaIssueId
     */
    public function getPanoramaIssueId()
    {
        return $this->panoramaIssueId;
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
     * @return the $panoramaIssueArea
     */
    public function getPanoramaIssueArea()
    {
        return $this->panoramaIssueArea;
    }

    /**
     *
     * @return the $panoramaIssueCategory
     */
    public function getPanoramaIssueCategory()
    {
        return $this->panoramaIssueCategory;
    }

    /**
     *
     * @return the $panoramaIssueType
     */
    public function getPanoramaIssueType()
    {
        return $this->panoramaIssueType;
    }

    /**
     *
     * @return the $panoramaIssueMessage
     */
    public function getPanoramaIssueMessage()
    {
        return $this->panoramaIssueMessage;
    }

    /**
     *
     * @return the $panoramaIssueFirstSeen
     */
    public function getPanoramaIssueFirstSeen()
    {
        return $this->panoramaIssueFirstSeen;
    }

    /**
     *
     * @return the $panoramaIssueLastSeen
     */
    public function getPanoramaIssueLastSeen()
    {
        return $this->panoramaIssueLastSeen;
    }

    /**
     *
     * @return the $panoramaIssueResolved
     */
    public function getPanoramaIssueResolved()
    {
        return $this->panoramaIssueResolved;
    }

    /**
     *
     * @return the $panoramaIssueResolvedTime
     */
    public function getPanoramaIssueResolvedTime()
    {
        return $this->panoramaIssueResolvedTime;
    }

    /**
     *
     * @return the $panoramaIssueSnoozed
     */
    public function getPanoramaIssueSnoozed()
    {
        return $this->panoramaIssueSnoozed;
    }

    /**
     *
     * @return the $panoramaIssueItemId
     */
    public function getPanoramaIssueItemId()
    {
        return $this->panoramaIssueItemId;
    }

    /**
     *
     * @return the $panoramaIssueVulnerability
     */
    public function getPanoramaIssueVulnerability()
    {
        return $this->panoramaIssueVulnerability;
    }

    /**
     *
     * @param string $panoramaIssueId            
     */
    public function setPanoramaIssueId($panoramaIssueId)
    {
        $this->panoramaIssueId = $panoramaIssueId;
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
     * @param string $panoramaIssueArea            
     */
    public function setPanoramaIssueArea($panoramaIssueArea)
    {
        $this->panoramaIssueArea = $panoramaIssueArea;
    }

    /**
     *
     * @param string $panoramaIssueCategory            
     */
    public function setPanoramaIssueCategory($panoramaIssueCategory)
    {
        $this->panoramaIssueCategory = $panoramaIssueCategory;
    }

    /**
     *
     * @param string $panoramaIssueType            
     */
    public function setPanoramaIssueType($panoramaIssueType)
    {
        $this->panoramaIssueType = $panoramaIssueType;
    }

    /**
     *
     * @param string $panoramaIssueMessage            
     */
    public function setPanoramaIssueMessage($panoramaIssueMessage)
    {
        $this->panoramaIssueMessage = $panoramaIssueMessage;
    }

    /**
     *
     * @param number $panoramaIssueFirstSeen            
     */
    public function setPanoramaIssueFirstSeen($panoramaIssueFirstSeen)
    {
        $this->panoramaIssueFirstSeen = $panoramaIssueFirstSeen;
    }

    /**
     *
     * @param number $panoramaIssueLastSeen            
     */
    public function setPanoramaIssueLastSeen($panoramaIssueLastSeen)
    {
        $this->panoramaIssueLastSeen = $panoramaIssueLastSeen;
    }

    /**
     *
     * @param number $panoramaIssueResolved            
     */
    public function setPanoramaIssueResolved($panoramaIssueResolved)
    {
        $this->panoramaIssueResolved = $panoramaIssueResolved;
    }

    /**
     *
     * @param number $panoramaIssueResolvedTime            
     */
    public function setPanoramaIssueResolvedTime($panoramaIssueResolvedTime)
    {
        $this->panoramaIssueResolvedTime = $panoramaIssueResolvedTime;
    }

    /**
     *
     * @param number $panoramaIssueSnoozed            
     */
    public function setPanoramaIssueSnoozed($panoramaIssueSnoozed)
    {
        $this->panoramaIssueSnoozed = $panoramaIssueSnoozed;
    }

    /**
     *
     * @param string $panoramaIssueItemId            
     */
    public function setPanoramaIssueItemId($panoramaIssueItemId)
    {
        $this->panoramaIssueItemId = $panoramaIssueItemId;
    }

    /**
     *
     * @param string $panoramaIssueVulnerability            
     */
    public function setPanoramaIssueVulnerability($panoramaIssueVulnerability)
    {
        $this->panoramaIssueVulnerability = $panoramaIssueVulnerability;
    }
}
