<?php
namespace WorkorderOption\Entity;

class OptionEntity
{

    /**
     *
     * @var number
     */
    protected $workorderOptionId;

    /**
     *
     * @var string
     */
    protected $workorderOptionDisclaimer;

    /**
     *
     * @return the $workorderOptionId
     */
    public function getWorkorderOptionId()
    {
        return $this->workorderOptionId;
    }

    /**
     *
     * @return the $workorderOptionDisclaimer
     */
    public function getWorkorderOptionDisclaimer()
    {
        return $this->workorderOptionDisclaimer;
    }

    /**
     *
     * @param number $workorderOptionId            
     */
    public function setWorkorderOptionId($workorderOptionId)
    {
        $this->workorderOptionId = $workorderOptionId;
    }

    /**
     *
     * @param string $workorderOptionDisclaimer            
     */
    public function setWorkorderOptionDisclaimer($workorderOptionDisclaimer)
    {
        $this->workorderOptionDisclaimer = $workorderOptionDisclaimer;
    }
}

