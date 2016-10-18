<?php
namespace Panorama\Entity;

class Ipv4Entity
{

    /**
     *
     * @var string
     */
    protected $ip;

    /**
     *
     * @var string
     */
    protected $mask;

    /**
     *
     * @var string
     */
    protected $gateway;

    /**
     *
     * @return the $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     *
     * @return the $mask
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     *
     * @return the $gateway
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     *
     * @param string $ip            
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     *
     * @param string $mask            
     */
    public function setMask($mask)
    {
        $this->mask = $mask;
    }

    /**
     *
     * @param string $gateway            
     */
    public function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }
}