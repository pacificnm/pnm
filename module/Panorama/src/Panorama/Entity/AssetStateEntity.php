<?php
namespace Panorama\Entity;

class AssetStateEntity
{

    /**
     *
     * @var String
     */
    protected $current;

    /**
     *
     * @var String
     */
    protected $changed;

    /**
     *
     * @var String
     */
    protected $meta;

    /**
     *
     * @return the $current
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     *
     * @return the $changed
     */
    public function getChanged()
    {
        return $this->changed;
    }

    /**
     *
     * @return the $meta
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     *
     * @param \Panorama\Entity\String $current            
     */
    public function setCurrent($current)
    {
        $this->current = $current;
    }

    /**
     *
     * @param \Panorama\Entity\String $changed            
     */
    public function setChanged($changed)
    {
        $this->changed = $changed;
    }

    /**
     *
     * @param \Panorama\Entity\String $meta            
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }
}