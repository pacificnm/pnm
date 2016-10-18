<?php
namespace Panorama\Entity;

class PartitionsEntity
{

    /**
     *
     * @var string
     */
    protected $partition;

    /**
     *
     * @var number
     */
    protected $size;

    /**
     *
     * @var number
     */
    protected $free;

    /**
     *
     * @return the $partition
     */
    public function getPartition()
    {
        return $this->partition;
    }

    /**
     *
     * @return the $size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     *
     * @return the $free
     */
    public function getFree()
    {
        return $this->free;
    }

    /**
     *
     * @param string $partition            
     */
    public function setPartition($partition)
    {
        $this->partition = $partition;
    }

    /**
     *
     * @param number $size            
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     *
     * @param number $free            
     */
    public function setFree($free)
    {
        $this->free = $free;
    }
}