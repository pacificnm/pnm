<?php
namespace Cron\Entity;

class CronEntity
{

    /**
     *
     * @var number
     */
    protected $cronId;

    /**
     *
     * @var number
     */
    protected $cronMinute;

    /**
     *
     * @var number
     */
    protected $cronHour;

    /**
     *
     * @var number
     */
    protected $cronDom;

    /**
     *
     * @var number
     */
    protected $cronMonth;

    /**
     *
     * @var string
     */
    protected $cronCommand;

    /**
     *
     * @var bool
     */
    protected $cronRunOnce;

    /**
     *
     * @var number
     */
    protected $cronLastRun;

    /**
     * 
     * @var number
     */
    protected $cronStatus;
    
    /**
     *
     * @var bool
     */
    protected $cronEnabled;
    /**
     * @return the $cronId
     */
    public function getCronId()
    {
        return $this->cronId;
    }

    /**
     * @return the $cronMinute
     */
    public function getCronMinute()
    {
        return $this->cronMinute;
    }

    /**
     * @return the $cronHour
     */
    public function getCronHour()
    {
        return $this->cronHour;
    }

    /**
     * @return the $cronDom
     */
    public function getCronDom()
    {
        return $this->cronDom;
    }

    /**
     * @return the $cronMonth
     */
    public function getCronMonth()
    {
        return $this->cronMonth;
    }

    /**
     * @return the $cronCommand
     */
    public function getCronCommand()
    {
        return $this->cronCommand;
    }

    /**
     * @return the $cronRunOnce
     */
    public function getCronRunOnce()
    {
        return $this->cronRunOnce;
    }

    /**
     * @return the $cronLastRun
     */
    public function getCronLastRun()
    {
        return $this->cronLastRun;
    }

    /**
     * @return the $cronStatus
     */
    public function getCronStatus()
    {
        return $this->cronStatus;
    }

    /**
     * @return the $cronEnabled
     */
    public function getCronEnabled()
    {
        return $this->cronEnabled;
    }

    /**
     * @param number $cronId
     */
    public function setCronId($cronId)
    {
        $this->cronId = $cronId;
    }

    /**
     * @param number $cronMinute
     */
    public function setCronMinute($cronMinute)
    {
        $this->cronMinute = $cronMinute;
    }

    /**
     * @param number $cronHour
     */
    public function setCronHour($cronHour)
    {
        $this->cronHour = $cronHour;
    }

    /**
     * @param number $cronDom
     */
    public function setCronDom($cronDom)
    {
        $this->cronDom = $cronDom;
    }

    /**
     * @param number $cronMonth
     */
    public function setCronMonth($cronMonth)
    {
        $this->cronMonth = $cronMonth;
    }

    /**
     * @param string $cronCommand
     */
    public function setCronCommand($cronCommand)
    {
        $this->cronCommand = $cronCommand;
    }

    /**
     * @param boolean $cronRunOnce
     */
    public function setCronRunOnce($cronRunOnce)
    {
        $this->cronRunOnce = $cronRunOnce;
    }

    /**
     * @param number $cronLastRun
     */
    public function setCronLastRun($cronLastRun)
    {
        $this->cronLastRun = $cronLastRun;
    }

    /**
     * @param number $cronStatus
     */
    public function setCronStatus($cronStatus)
    {
        $this->cronStatus = $cronStatus;
    }

    /**
     * @param boolean $cronEnabled
     */
    public function setCronEnabled($cronEnabled)
    {
        $this->cronEnabled = $cronEnabled;
    }


   
}