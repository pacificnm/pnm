<?php
namespace Config\Entity;

interface ConfigEntityInterface
{

    /**
     *
     * @return the $configId
     */
    public function getConfigId();

    /**
     *
     * @return the $configVersion
     */
    public function getConfigVersion();

    /**
     *
     * @return the $configCopyYear
     */
    public function getConfigCopyYear();

    /**
     *
     * @return the $configCompanyName
     */
    public function getConfigCompanyName();

    /**
     *
     * @return the $configCompanyStreet
     */
    public function getConfigCompanyStreet();

    /**
     *
     * @return the $configCompanyStreetCont
     */
    public function getConfigCompanyStreetCont();

    /**
     *
     * @return the $configComppanyCity
     */
    public function getConfigComppanyCity();

    /**
     *
     * @return the $configCompanyState
     */
    public function getConfigCompanyState();

    /**
     *
     * @return the $configCompanyPostal
     */
    public function getConfigCompanyPostal();

    /**
     *
     * @return the $configCompanyPhone
     */
    public function getConfigCompanyPhone();

    /**
     *
     * @return the $configCompanyPhoneAlt
     */
    public function getConfigCompanyPhoneAlt();

    /**
     *
     * @return the $configHttpAddress
     */
    public function getConfigHttpAddress();

    /**
     *
     * @return the $configDateLong
     */
    public function getConfigDateLong();

    /**
     *
     * @return the $configDateShort
     */
    public function getConfigDateShort();

    /**
     *
     * @return the $configLang
     */
    public function getConfigLang();

    /**
     *
     * @return the $configCurrency
     */
    public function getConfigCurrency();

    /**
     *
     * @param number $configId            
     */
    public function setConfigId($configId);

    /**
     *
     * @param string $configVersion            
     */
    public function setConfigVersion($configVersion);

    /**
     *
     * @param string $configCopyYear            
     */
    public function setConfigCopyYear($configCopyYear);

    /**
     *
     * @param string $configCompanyName            
     */
    public function setConfigCompanyName($configCompanyName);

    /**
     *
     * @param string $configCompanyStreet            
     */
    public function setConfigCompanyStreet($configCompanyStreet);

    /**
     *
     * @param string $configCompanyStreetCont            
     */
    public function setConfigCompanyStreetCont($configCompanyStreetCont);

    /**
     *
     * @param string $configComppanyCity            
     */
    public function setConfigComppanyCity($configComppanyCity);

    /**
     *
     * @param string $configCompanyState            
     */
    public function setConfigCompanyState($configCompanyState);

    /**
     *
     * @param string $configCompanyPostal            
     */
    public function setConfigCompanyPostal($configCompanyPostal);

    /**
     *
     * @param string $configCompanyPhone            
     */
    public function setConfigCompanyPhone($configCompanyPhone);

    /**
     *
     * @param string $configCompanyPhoneAlt            
     */
    public function setConfigCompanyPhoneAlt($configCompanyPhoneAlt);

    /**
     *
     * @param string $configHttpAddress            
     */
    public function setConfigHttpAddress($configHttpAddress);

    /**
     *
     * @param string $configDateLong            
     */
    public function setConfigDateLong($configDateLong);

    /**
     *
     * @param string $configDateShort            
     */
    public function setConfigDateShort($configDateShort);

    /**
     *
     * @param string $configLang            
     */
    public function setConfigLang($configLang);

    /**
     *
     * @param string $configCurrency            
     */
    public function setConfigCurrency($configCurrency);
}
