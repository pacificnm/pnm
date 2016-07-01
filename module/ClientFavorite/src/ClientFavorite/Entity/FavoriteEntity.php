<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace ClientFavorite\Entity;

use Client\Entity\ClientEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class FavoriteEntity
{

    /**
     *
     * @var number
     */
    protected $clientFavoriteId;

    /**
     *
     * @var number
     */
    protected $authId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $clientFavoriteTime;

    /**
     *
     * @var ClientEntity
     */
    protected $clientEntity;

    /**
     *
     * @return the $clientFavoriteId
     */
    public function getClientFavoriteId()
    {
        return $this->clientFavoriteId;
    }

    /**
     *
     * @return the $authId
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     *
     * @return the $clientId
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     *
     * @return the $clientFavoriteTime
     */
    public function getClientFavoriteTime()
    {
        return $this->clientFavoriteTime;
    }

    /**
     *
     * @return the $clientEntity
     */
    public function getClientEntity()
    {
        return $this->clientEntity;
    }

    /**
     *
     * @param number $clientFavoriteId            
     */
    public function setClientFavoriteId($clientFavoriteId)
    {
        $this->clientFavoriteId = $clientFavoriteId;
    }

    /**
     *
     * @param number $authId            
     */
    public function setAuthId($authId)
    {
        $this->authId = $authId;
    }

    /**
     *
     * @param number $clientId            
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     *
     * @param number $clientFavoriteTime            
     */
    public function setClientFavoriteTime($clientFavoriteTime)
    {
        $this->clientFavoriteTime = $clientFavoriteTime;
    }

    /**
     *
     * @param \Client\Entity\ClientEntity $clientEntity            
     */
    public function setClientEntity($clientEntity)
    {
        $this->clientEntity = $clientEntity;
    }
}