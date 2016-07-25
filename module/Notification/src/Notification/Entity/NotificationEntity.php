<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Notification\Entity;

use Employee\Entity\EmployeeEntity;

class NotificationEntity
{

    /**
     *
     * @var number
     */
    protected $notificationId;

    /**
     *
     * @var employeeId
     */
    protected $employeeId;

    /**
     *
     * @var number
     */
    protected $notificationDate;

    /**
     *
     * @var string
     */
    protected $notificationStatus;

    /**
     *
     * @var string
     */
    protected $notificationText;

    /**
     *
     * @var EmployeeEntity
     */
    protected $employeeEntity;

    /**
     *
     * @return the $notificationId
     */
    public function getNotificationId()
    {
        return $this->notificationId;
    }

    /**
     *
     * @return the $employeeId
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     *
     * @return the $notificationDate
     */
    public function getNotificationDate()
    {
        return $this->notificationDate;
    }

    /**
     *
     * @return the $notificationStatus
     */
    public function getNotificationStatus()
    {
        return $this->notificationStatus;
    }

    /**
     *
     * @return the $notificationText
     */
    public function getNotificationText()
    {
        return $this->notificationText;
    }

    /**
     *
     * @return the $employeeEntity
     */
    public function getEmployeeEntity()
    {
        return $this->employeeEntity;
    }

    /**
     *
     * @param number $notificationId            
     */
    public function setNotificationId($notificationId)
    {
        $this->notificationId = $notificationId;
    }

    /**
     *
     * @param \Notification\Entity\employeeId $employeeId            
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    /**
     *
     * @param number $notificationDate            
     */
    public function setNotificationDate($notificationDate)
    {
        $this->notificationDate = $notificationDate;
    }

    /**
     *
     * @param string $notificationStatus            
     */
    public function setNotificationStatus($notificationStatus)
    {
        $this->notificationStatus = $notificationStatus;
    }

    /**
     *
     * @param string $notificationText            
     */
    public function setNotificationText($notificationText)
    {
        $this->notificationText = $notificationText;
    }

    /**
     *
     * @param \Employee\Entity\EmployeeEntity $employeeEntity            
     */
    public function setEmployeeEntity($employeeEntity)
    {
        $this->employeeEntity = $employeeEntity;
    }
}
