<?php
namespace History\Entity;

use Auth\Entity\AuthEntity;

class HistoryEntity
{

    /**
     *
     * @var number
     */
    protected $historyId;

    /**
     *
     * @var number
     */
    protected $authId;

    /**
     *
     * @var string
     */
    protected $historyAction;

    /**
     *
     * @var string
     */
    protected $historyUrl;

    /**
     *
     * @var string
     */
    protected $historyNote;

    /**
     *
     * @var number
     */
    protected $historyTime;

    /**
     *
     * @var AuthEntity
     */
    protected $authEntity;

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
     * @return the $authId
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     *
     * @return the $historyAction
     */
    public function getHistoryAction()
    {
        return $this->historyAction;
    }

    /**
     *
     * @return the $historyUrl
     */
    public function getHistoryUrl()
    {
        return $this->historyUrl;
    }

    /**
     *
     * @return the $historyNote
     */
    public function getHistoryNote()
    {
        return $this->historyNote;
    }

    /**
     *
     * @return the $historyTime
     */
    public function getHistoryTime()
    {
        return $this->historyTime;
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
     * @param number $historyId            
     */
    public function setHistoryId($historyId)
    {
        $this->historyId = $historyId;
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
     * @param string $historyAction            
     */
    public function setHistoryAction($historyAction)
    {
        $this->historyAction = $historyAction;
    }

    /**
     *
     * @param string $historyUrl            
     */
    public function setHistoryUrl($historyUrl)
    {
        $this->historyUrl = $historyUrl;
    }

    /**
     *
     * @param string $historyNote            
     */
    public function setHistoryNote($historyNote)
    {
        $this->historyNote = $historyNote;
    }

    /**
     *
     * @param number $historyTime            
     */
    public function setHistoryTime($historyTime)
    {
        $this->historyTime = $historyTime;
    }

    /**
     *
     * @param \Auth\Entity\AuthEntity $authEntity            
     */
    public function setAuthEntity($authEntity)
    {
        $this->authEntity = $authEntity;
    }
}