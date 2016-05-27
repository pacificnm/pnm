<?php
namespace Client\Entity;

interface ClientEntityInterface
{

    /**
     *
     * @return the $clientId
     */
    public function getClientId();

    /**
     *
     * @return the $clientName
     */
    public function getClientName();

    /**
     *
     * @return the $clientStatus
     */
    public function getClientStatus();

    /**
     *
     * @return the $clientCreated
     */
    public function getClientCreated();

    /**
     *
     * @return the $locationEntity
     */
    public function getLocationEntity();

    /**
     *
     * @return the $phoneEntity
     */
    public function getPhoneEntity();

    /**
     *
     * @return the $userEntity
     */
    public function getUserEntity();

    /**
     *
     * @param number $clientId            
     */
    public function setClientId($clientId);

    /**
     *
     * @param string $clientName            
     */
    public function setClientName($clientName);

    /**
     *
     * @param string $clientStatus            
     */
    public function setClientStatus($clientStatus);

    /**
     *
     * @param number $clientCreated            
     */
    public function setClientCreated($clientCreated);

    /**
     *
     * @param \Location\Entity\LocationEntity $locationEntity            
     */
    public function setLocationEntity($locationEntity);

    /**
     *
     * @param \Phone\Entity\PhoneEntity $phoneEntity            
     */
    public function setPhoneEntity($phoneEntity);

    /**
     *
     * @param \User\Entity\UserEntity $userEntity            
     */
    public function setUserEntity($userEntity);
}