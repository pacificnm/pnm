<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Estimate\Entity;

use Client\Entity\ClientEntity;
use Employee\Entity\EmployeeEntity;

class EstimateEntity
{

    /**
     *
     * @var number
     */
    protected $estimateId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $employeeId;

    /**
     *
     * @var number
     */
    protected $estimateDateCreate;

    /**
     *
     * @var number
     */
    protected $estimateDateDue;

    /**
     *
     * @var string
     */
    protected $estimateTitle;

    /**
     *
     * @var string
     */
    protected $estimateOverview;

    /**
     *
     * @var string
     */
    protected $estimateDescription;

    /**
     *
     * @var EmployeeEntity
     */
    protected $employeeEntity;

    /**
     *
     * @var ClientEntity
     */
    protected $clientEntity;

    /**
     *
     * @return the $estimateId
     */
    public function getEstimateId()
    {
        return $this->estimateId;
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
     * @return the $employeeId
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     *
     * @return the $estimateDateCreate
     */
    public function getEstimateDateCreate()
    {
        return $this->estimateDateCreate;
    }

    /**
     *
     * @return the $estimateDateDue
     */
    public function getEstimateDateDue()
    {
        return $this->estimateDateDue;
    }

    /**
     *
     * @return the $estimateTitle
     */
    public function getEstimateTitle()
    {
        return $this->estimateTitle;
    }

    /**
     *
     * @return the $estimateOverview
     */
    public function getEstimateOverview()
    {
        return $this->estimateOverview;
    }

    /**
     *
     * @return the $estimateDescription
     */
    public function getEstimateDescription()
    {
        return $this->estimateDescription;
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
     * @return the $clientEntity
     */
    public function getClientEntity()
    {
        return $this->clientEntity;
    }

    /**
     *
     * @param number $estimateId            
     */
    public function setEstimateId($estimateId)
    {
        $this->estimateId = $estimateId;
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
     * @param number $employeeId            
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    /**
     *
     * @param number $estimateDateCreate            
     */
    public function setEstimateDateCreate($estimateDateCreate)
    {
        $this->estimateDateCreate = $estimateDateCreate;
    }

    /**
     *
     * @param number $estimateDateDue            
     */
    public function setEstimateDateDue($estimateDateDue)
    {
        $this->estimateDateDue = $estimateDateDue;
    }

    /**
     *
     * @param string $estimateTitle            
     */
    public function setEstimateTitle($estimateTitle)
    {
        $this->estimateTitle = $estimateTitle;
    }

    /**
     *
     * @param string $estimateOverview            
     */
    public function setEstimateOverview($estimateOverview)
    {
        $this->estimateOverview = $estimateOverview;
    }

    /**
     *
     * @param string $estimateDescription            
     */
    public function setEstimateDescription($estimateDescription)
    {
        $this->estimateDescription = $estimateDescription;
    }

    /**
     *
     * @param \Employee\Entity\EmployeeEntity $employeeEntity            
     */
    public function setEmployeeEntity($employeeEntity)
    {
        $this->employeeEntity = $employeeEntity;
    }

    /**
     *
     * @param \Client\Entity\ClientEntity $clientEntity            
     */
    public function setClientEntity($clientEntity)
    {
        $this->clientEntity = $clientEntity;
    }
}