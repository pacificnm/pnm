<?php
namespace Labor\Entity;

interface LaborEntityInterface
{

    /**
     *
     * @return the $laborId
     */
    public function getLaborId();

    /**
     *
     * @return the $laborName
     */
    public function getLaborName();

    /**
     *
     * @return the $laborAmount
     */
    public function getLaborAmount();

    /**
     *
     * @param number $laborId            
     */
    public function setLaborId($laborId);

    /**
     *
     * @param string $laborName            
     */
    public function setLaborName($laborName);

    /**
     *
     * @param number $laborAmount            
     */
    public function setLaborAmount($laborAmount);
}