<?php
namespace ReportProfit\Entity;

class ReportProfitEntity
{

    /**
     *
     * @var number
     */
    protected $reportProfitId;

    /**
     *
     * @var float
     */
    protected $reportProfitLabor;

    /**
     *
     * @var float
     */
    protected $reportProfitParts;

    /**
     *
     * @var float
     */
    protected $reportProfitExpense;

    /**
     *
     * @var number
     */
    protected $reportProfitMonth;

    /**
     *
     * @var number
     */
    protected $reportProfitYear;

    /**
     *
     * @var number
     */
    protected $reportProfitUpdated;

    /**
     *
     * @return the $reportProfitId
     */
    public function getReportProfitId()
    {
        return $this->reportProfitId;
    }

    /**
     *
     * @return the $reportProfitLabor
     */
    public function getReportProfitLabor()
    {
        return $this->reportProfitLabor;
    }

    /**
     *
     * @return the $reportProfitParts
     */
    public function getReportProfitParts()
    {
        return $this->reportProfitParts;
    }

    /**
     *
     * @return the $reportProfitExpense
     */
    public function getReportProfitExpense()
    {
        return $this->reportProfitExpense;
    }

    /**
     *
     * @return the $reportProfitMonth
     */
    public function getReportProfitMonth()
    {
        return $this->reportProfitMonth;
    }

    /**
     *
     * @return the $reportProfitYear
     */
    public function getReportProfitYear()
    {
        return $this->reportProfitYear;
    }

    /**
     *
     * @return the $reportProfitUpdated
     */
    public function getReportProfitUpdated()
    {
        return $this->reportProfitUpdated;
    }

    /**
     *
     * @param number $reportProfitId            
     */
    public function setReportProfitId($reportProfitId)
    {
        $this->reportProfitId = $reportProfitId;
    }

    /**
     *
     * @param number $reportProfitLabor            
     */
    public function setReportProfitLabor($reportProfitLabor)
    {
        $this->reportProfitLabor = $reportProfitLabor;
    }

    /**
     *
     * @param number $reportProfitParts            
     */
    public function setReportProfitParts($reportProfitParts)
    {
        $this->reportProfitParts = $reportProfitParts;
    }

    /**
     *
     * @param number $reportProfitExpense            
     */
    public function setReportProfitExpense($reportProfitExpense)
    {
        $this->reportProfitExpense = $reportProfitExpense;
    }

    /**
     *
     * @param number $reportProfitMonth            
     */
    public function setReportProfitMonth($reportProfitMonth)
    {
        $this->reportProfitMonth = $reportProfitMonth;
    }

    /**
     *
     * @param number $reportProfitYear            
     */
    public function setReportProfitYear($reportProfitYear)
    {
        $this->reportProfitYear = $reportProfitYear;
    }

    /**
     *
     * @param number $reportProfitUpdated            
     */
    public function setReportProfitUpdated($reportProfitUpdated)
    {
        $this->reportProfitUpdated = $reportProfitUpdated;
    }
}

