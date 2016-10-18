<?php
namespace WorkorderEmail\Entity;

use Email\Entity\EmailEntity;
use Workorder\Entity\WorkorderEntity;

class WorkorderEmailEntity
{

    /**
     *
     * @var number
     */
    protected $workorderEmailId;

    /**
     *
     * @var number
     */
    protected $emailId;

    /**
     *
     * @var number
     */
    protected $workorderId;

    /**
     *
     * @var EmailEntity
     */
    protected $emailEntity;

    /**
     *
     * @var WorkorderEntity
     */
    protected $workorderEntity;

    /**
     *
     * @return the $workorderEmailId
     */
    public function getWorkorderEmailId()
    {
        return $this->workorderEmailId;
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
     * @return the $workorderId
     */
    public function getWorkorderId()
    {
        return $this->workorderId;
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
     * @return the $workorderEntity
     */
    public function getWorkorderEntity()
    {
        return $this->workorderEntity;
    }

    /**
     *
     * @param number $workorderEmailId            
     */
    public function setWorkorderEmailId($workorderEmailId)
    {
        $this->workorderEmailId = $workorderEmailId;
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
     * @param number $workorderId            
     */
    public function setWorkorderId($workorderId)
    {
        $this->workorderId = $workorderId;
    }

    /**
     *
     * @param \Email\Entity\EmailEntity $emailEntity            
     */
    public function setEmailEntity($emailEntity)
    {
        $this->emailEntity = $emailEntity;
    }

    /**
     *
     * @param \Workorder\Entity\WorkorderEntity $workorderEntity            
     */
    public function setWorkorderEntity($workorderEntity)
    {
        $this->workorderEntity = $workorderEntity;
    }
}