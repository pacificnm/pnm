<?php
namespace Panorama\Entity;

class RemoteControlEntity
{

    /**
     *
     * @var string
     */
    protected $provider;

    /**
     *
     * @var string
     */
    protected $url;

    /**
     *
     * @return the $provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     *
     * @return the $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *
     * @param string $provider            
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     *
     * @param string $url            
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}