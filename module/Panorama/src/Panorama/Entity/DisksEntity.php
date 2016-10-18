<?php
namespace Panorama\Entity;

class DisksEntity
{

    /**
     *
     * @var number
     */
    protected $diskId;

    /**
     *
     * @var string
     */
    protected $manufacturer;

    /**
     *
     * @var string
     */
    protected $model;

    /**
     *
     * @var number
     */
    protected $size;

    /**
     *
     * @return the $diskId
     */
    public function getDiskId()
    {
        return $this->diskId;
    }

    /**
     *
     * @return the $manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     *
     * @return the $model
     */
    public function getModel()
    {
        return $this->model;
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
     * @param number $diskId            
     */
    public function setDiskId($diskId)
    {
        $this->diskId = $diskId;
    }

    /**
     *
     * @param string $manufacturer            
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     *
     * @param string $model            
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     *
     * @param number $size            
     */
    public function setSize($size)
    {
        $this->size = $size;
    }
}

?>