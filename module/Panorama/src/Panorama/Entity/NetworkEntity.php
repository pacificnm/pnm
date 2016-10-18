<?php
namespace Panorama\Entity;

class NetworkEntity
{

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
     * @var string
     */
    protected $type;

    /**
     *
     * @var string
     */
    protected $macAddress;

    /**
     *
     * @var number
     */
    protected $speed;

    /**
     *
     * @var bool
     */
    protected $dhcp;

    /**
     *
     * @var Ipv4Entity
     */
    protected $ipv4Entity;

    /**
     *
     * @var DnsEntity
     */
    protected $dnsEntity;

    /**
     *
     * @var Ipv6Entity
     */
    protected $ipv6Entity;

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
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @return the $macAddress
     */
    public function getMacAddress()
    {
        return $this->macAddress;
    }

    /**
     *
     * @return the $speed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     *
     * @return the $dhcp
     */
    public function getDhcp()
    {
        return $this->dhcp;
    }

    /**
     *
     * @return the $ipv4Entity
     */
    public function getIpv4Entity()
    {
        return $this->ipv4Entity;
    }

    /**
     *
     * @return the $dnsEntity
     */
    public function getDnsEntity()
    {
        return $this->dnsEntity;
    }

    /**
     *
     * @return the $ipv6Entity
     */
    public function getIpv6Entity()
    {
        return $this->ipv6Entity;
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
     * @param string $type            
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     *
     * @param string $macAddress            
     */
    public function setMacAddress($macAddress)
    {
        $this->macAddress = $macAddress;
    }

    /**
     *
     * @param number $speed            
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    /**
     *
     * @param boolean $dhcp            
     */
    public function setDhcp($dhcp)
    {
        $this->dhcp = $dhcp;
    }

    /**
     *
     * @param \Panorama\Entity\Ipv4Entity $ipv4Entity            
     */
    public function setIpv4Entity($ipv4Entity)
    {
        $this->ipv4Entity = $ipv4Entity;
    }

    /**
     *
     * @param \Panorama\Entity\DnsEntity $dnsEntity            
     */
    public function setDnsEntity($dnsEntity)
    {
        $this->dnsEntity = $dnsEntity;
    }

    /**
     *
     * @param \Panorama\Entity\Ipv6Entity $ipv6Entity            
     */
    public function setIpv6Entity($ipv6Entity)
    {
        $this->ipv6Entity = $ipv6Entity;
    }
}