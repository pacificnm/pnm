<?php
namespace Panorama\Entity;

class Ipv6Entity
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
}