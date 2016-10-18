<?php
namespace Panorama\Entity;

class DeviceEntity
{

    /**
     *
     * @var number
     */
    protected $deviceId;

    /**
     *
     * @var string
     */
    protected $deviceType;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $alias;

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
    protected $serialNumber;

    /**
     *
     * @var number
     */
    protected $memory;

    /**
     *
     * @var bool
     */
    protected $isOnline;

    /**
     *
     * @var string
     */
    protected $os;

    /**
     *
     * @var number
     */
    protected $osBitSize;

    /**
     *
     * @var string
     */
    protected $uptime;

    /**
     *
     * @var string
     */
    protected $domain;

    /**
     *
     * @var string
     */
    protected $firstSeen;

    /**
     *
     * @var string
     */
    protected $lastSeen;

    /**
     *
     * @var string
     */
    protected $utcOffset;

    /**
     *
     * @var string
     */
    protected $warrantyDate;

    /**
     *
     * @var string
     */
    protected $shippingDate;

    /**
     *
     * @var string
     */
    protected $firstUseDate;

    /**
     *
     * @var string
     */
    protected $barcode;

    /**
     *
     * @var string
     */
    protected $manualsUri;

    /**
     *
     * @var string
     */
    protected $driversUri;

    /**
     *
     * @var string
     */
    protected $systemConfigUri;

    /**
     *
     * @var float
     */
    protected $price;

    /**
     *
     * @var float
     */
    protected $priceCurrency;

    protected $erpInvoiceNumber;

    protected $invoiceUri;

    protected $contractUri;

    /**
     *
     * @var CpuEntity
     */
    protected $cpuEntity;

    /**
     *
     * @var DisksEntity
     */
    protected $disksEntity;

    /**
     *
     * @var PartitionsEntity
     */
    protected $partitionsEntity;

    /**
     *
     * @var VideoEntity
     */
    protected $videoEntity;

    /**
     *
     * @var AudioEntity
     */
    protected $audioEntity;

    /**
     *
     * @var AssetStateEntity
     */
    protected $assetStateEntity;

    /**
     *
     * @var LocationEntity
     */
    protected $locationEntity;

    /**
     *
     * @var NetworkEntity
     */
    protected $networkEntity;

    /**
     *
     * @var UserEntity
     */
    protected $userEntity;

    /**
     *
     * @var RemoteControlEntity
     */
    protected $remoteControlEntity;

    /**
     *
     * @var ViewsEntity
     */
    protected $viewsEntity;

    /**
     *
     * @var string
     */
    protected $notes;

    /**
     *
     * @var ImagesEntity
     */
    protected $imagesEntity;

    /**
     *
     * @return the $deviceId
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     *
     * @return the $deviceType
     */
    public function getDeviceType()
    {
        return $this->deviceType;
    }

    /**
     *
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return the $alias
     */
    public function getAlias()
    {
        return $this->alias;
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
     * @return the $serialNumber
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     *
     * @return the $memory
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     *
     * @return the $isOnline
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     *
     * @return the $os
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     *
     * @return the $osBitSize
     */
    public function getOsBitSize()
    {
        return $this->osBitSize;
    }

    /**
     *
     * @return the $uptime
     */
    public function getUptime()
    {
        return $this->uptime;
    }

    /**
     *
     * @return the $domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     *
     * @return the $firstSeen
     */
    public function getFirstSeen()
    {
        return $this->firstSeen;
    }

    /**
     *
     * @return the $lastSeen
     */
    public function getLastSeen()
    {
        return $this->lastSeen;
    }

    /**
     *
     * @return the $utcOffset
     */
    public function getUtcOffset()
    {
        return $this->utcOffset;
    }

    /**
     *
     * @return the $warrantyDate
     */
    public function getWarrantyDate()
    {
        return $this->warrantyDate;
    }

    /**
     *
     * @return the $shippingDate
     */
    public function getShippingDate()
    {
        return $this->shippingDate;
    }

    /**
     *
     * @return the $firstUseDate
     */
    public function getFirstUseDate()
    {
        return $this->firstUseDate;
    }

    /**
     *
     * @return the $barcode
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     *
     * @return the $manualsUri
     */
    public function getManualsUri()
    {
        return $this->manualsUri;
    }

    /**
     *
     * @return the $driversUri
     */
    public function getDriversUri()
    {
        return $this->driversUri;
    }

    /**
     *
     * @return the $systemConfigUri
     */
    public function getSystemConfigUri()
    {
        return $this->systemConfigUri;
    }

    /**
     *
     * @return the $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     *
     * @return the $priceCurrency
     */
    public function getPriceCurrency()
    {
        return $this->priceCurrency;
    }

    /**
     *
     * @return the $erpInvoiceNumber
     */
    public function getErpInvoiceNumber()
    {
        return $this->erpInvoiceNumber;
    }

    /**
     *
     * @return the $invoiceUri
     */
    public function getInvoiceUri()
    {
        return $this->invoiceUri;
    }

    /**
     *
     * @return the $contractUri
     */
    public function getContractUri()
    {
        return $this->contractUri;
    }

    /**
     *
     * @return the $cpuEntity
     */
    public function getCpuEntity()
    {
        return $this->cpuEntity;
    }

    /**
     *
     * @return the $disksEntity
     */
    public function getDisksEntity()
    {
        return $this->disksEntity;
    }

    /**
     *
     * @return the $partitionsEntity
     */
    public function getPartitionsEntity()
    {
        return $this->partitionsEntity;
    }

    /**
     *
     * @return the $videoEntity
     */
    public function getVideoEntity()
    {
        return $this->videoEntity;
    }

    /**
     *
     * @return the $audioEntity
     */
    public function getAudioEntity()
    {
        return $this->audioEntity;
    }

    /**
     *
     * @return the $assetStateEntity
     */
    public function getAssetStateEntity()
    {
        return $this->assetStateEntity;
    }

    /**
     *
     * @return the $locationEntity
     */
    public function getLocationEntity()
    {
        return $this->locationEntity;
    }

    /**
     *
     * @return the $networkEntity
     */
    public function getNetworkEntity()
    {
        return $this->networkEntity;
    }

    /**
     *
     * @return the $userEntity
     */
    public function getUserEntity()
    {
        return $this->userEntity;
    }

    /**
     *
     * @return the $remoteControlEntity
     */
    public function getRemoteControlEntity()
    {
        return $this->remoteControlEntity;
    }

    /**
     *
     * @return the $viewsEntity
     */
    public function getViewsEntity()
    {
        return $this->viewsEntity;
    }

    /**
     *
     * @return the $notes
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     *
     * @return the $imagesEntity
     */
    public function getImagesEntity()
    {
        return $this->imagesEntity;
    }

    /**
     *
     * @param number $deviceId            
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
    }

    /**
     *
     * @param string $deviceType            
     */
    public function setDeviceType($deviceType)
    {
        $this->deviceType = $deviceType;
    }

    /**
     *
     * @param string $name            
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param string $alias            
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
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
     * @param string $serialNumber            
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     *
     * @param number $memory            
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;
    }

    /**
     *
     * @param boolean $isOnline            
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;
    }

    /**
     *
     * @param string $os            
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     *
     * @param number $osBitSize            
     */
    public function setOsBitSize($osBitSize)
    {
        $this->osBitSize = $osBitSize;
    }

    /**
     *
     * @param string $uptime            
     */
    public function setUptime($uptime)
    {
        $this->uptime = $uptime;
    }

    /**
     *
     * @param string $domain            
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     *
     * @param string $firstSeen            
     */
    public function setFirstSeen($firstSeen)
    {
        $this->firstSeen = $firstSeen;
    }

    /**
     *
     * @param string $lastSeen            
     */
    public function setLastSeen($lastSeen)
    {
        $this->lastSeen = $lastSeen;
    }

    /**
     *
     * @param string $utcOffset            
     */
    public function setUtcOffset($utcOffset)
    {
        $this->utcOffset = $utcOffset;
    }

    /**
     *
     * @param string $warrantyDate            
     */
    public function setWarrantyDate($warrantyDate)
    {
        $this->warrantyDate = $warrantyDate;
    }

    /**
     *
     * @param string $shippingDate            
     */
    public function setShippingDate($shippingDate)
    {
        $this->shippingDate = $shippingDate;
    }

    /**
     *
     * @param string $firstUseDate            
     */
    public function setFirstUseDate($firstUseDate)
    {
        $this->firstUseDate = $firstUseDate;
    }

    /**
     *
     * @param string $barcode            
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     *
     * @param string $manualsUri            
     */
    public function setManualsUri($manualsUri)
    {
        $this->manualsUri = $manualsUri;
    }

    /**
     *
     * @param string $driversUri            
     */
    public function setDriversUri($driversUri)
    {
        $this->driversUri = $driversUri;
    }

    /**
     *
     * @param string $systemConfigUri            
     */
    public function setSystemConfigUri($systemConfigUri)
    {
        $this->systemConfigUri = $systemConfigUri;
    }

    /**
     *
     * @param number $price            
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     *
     * @param number $priceCurrency            
     */
    public function setPriceCurrency($priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;
    }

    /**
     *
     * @param field_type $erpInvoiceNumber            
     */
    public function setErpInvoiceNumber($erpInvoiceNumber)
    {
        $this->erpInvoiceNumber = $erpInvoiceNumber;
    }

    /**
     *
     * @param field_type $invoiceUri            
     */
    public function setInvoiceUri($invoiceUri)
    {
        $this->invoiceUri = $invoiceUri;
    }

    /**
     *
     * @param field_type $contractUri            
     */
    public function setContractUri($contractUri)
    {
        $this->contractUri = $contractUri;
    }

    /**
     *
     * @param \Panorama\Entity\CpuEntity $cpuEntity            
     */
    public function setCpuEntity($cpuEntity)
    {
        $this->cpuEntity = $cpuEntity;
    }

    /**
     *
     * @param \Panorama\Entity\DisksEntity $disksEntity            
     */
    public function setDisksEntity($disksEntity)
    {
        $this->disksEntity = $disksEntity;
    }

    /**
     *
     * @param \Panorama\Entity\PartitionsEntity $partitionsEntity            
     */
    public function setPartitionsEntity($partitionsEntity)
    {
        $this->partitionsEntity = $partitionsEntity;
    }

    /**
     *
     * @param \Panorama\Entity\VideoEntity $videoEntity            
     */
    public function setVideoEntity($videoEntity)
    {
        $this->videoEntity = $videoEntity;
    }

    /**
     *
     * @param \Panorama\Entity\AudioEntity $audioEntity            
     */
    public function setAudioEntity($audioEntity)
    {
        $this->audioEntity = $audioEntity;
    }

    /**
     *
     * @param \Panorama\Entity\AssetStateEntity $assetStateEntity            
     */
    public function setAssetStateEntity($assetStateEntity)
    {
        $this->assetStateEntity = $assetStateEntity;
    }

    /**
     *
     * @param \Panorama\Entity\LocationEntity $locationEntity            
     */
    public function setLocationEntity($locationEntity)
    {
        $this->locationEntity = $locationEntity;
    }

    /**
     *
     * @param \Panorama\Entity\NetworkEntity $networkEntity            
     */
    public function setNetworkEntity($networkEntity)
    {
        $this->networkEntity = $networkEntity;
    }

    /**
     *
     * @param \Panorama\Entity\UserEntity $userEntity            
     */
    public function setUserEntity($userEntity)
    {
        $this->userEntity = $userEntity;
    }

    /**
     *
     * @param \Panorama\Entity\RemoteControlEntity $remoteControlEntity            
     */
    public function setRemoteControlEntity($remoteControlEntity)
    {
        $this->remoteControlEntity = $remoteControlEntity;
    }

    /**
     *
     * @param \Panorama\Entity\ViewsEntity $viewsEntity            
     */
    public function setViewsEntity($viewsEntity)
    {
        $this->viewsEntity = $viewsEntity;
    }

    /**
     *
     * @param string $notes            
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     *
     * @param \Panorama\Entity\ImagesEntity $imagesEntity            
     */
    public function setImagesEntity($imagesEntity)
    {
        $this->imagesEntity = $imagesEntity;
    }
}

?>