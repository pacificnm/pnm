<?php
namespace HostAttributeMap\Service;

use HostAttributeMap\Entity\MapEntity;
use HostAttributeMap\Mapper\MapMapperInterface;
use HostAttributeValue\Service\ValueServiceInterface;
use HostAttributeValue\Entity\ValueEntity;
use Zend\Crypt\BlockCipher;


class MapService implements MapServiceInterface
{

    /**
     *
     * @var MapMapperInterface
     */
    protected $mapper;

    /**
     *
     * @var ValueServiceInterface
     */
    protected $valueService;

    /**
     * 
     * @var array
     */
    protected $config;
    
    /**
     * 
     * @param MapMapperInterface $mapper
     * @param ValueServiceInterface $valueService
     * @param array $config
     */
    public function __construct(MapMapperInterface $mapper, ValueServiceInterface $valueService, array $config)
    {
        $this->mapper = $mapper;
   
        $this->valueService = $valueService;
        
        $this->config = $config;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttributeMap\Service\MapServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttributeMap\Service\MapServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::getHostAttributes()
     */
    public function getHostAttributes($hostId)
    {
        $filter = array(
            'hostId' => $hostId
        );
        
        return $this->mapper->getAll($filter);
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttributeMap\Service\MapServiceInterface::save()
     */
    public function save(MapEntity $entity)
    {
        return $this->mapper->save($entity);
    }

   
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::saveSelect()
     */
    public function saveSelect($hostId, $hostAttributeId, $hostAttributeMapValue)
    {
        
        $mapEntity = new MapEntity();
        
        // check if we have a value already
        if(is_numeric($hostAttributeMapValue)) {
            $valueEntity = $this->valueService->get($hostAttributeMapValue);
        } else {
            $valueEntity = $this->valueService->getValue($hostAttributeMapValue);
        }
        
        // if no value create one
        if(! $valueEntity) {
            $valueEntity = new ValueEntity();
            $valueEntity->setHostAttributeId($hostAttributeId);
            $valueEntity->setHostAttributeValueName($hostAttributeMapValue);
            
            $valueEntity = $this->valueService->save($valueEntity);
        }
        
        $mapEntity->setHostId($hostId);
        $mapEntity->setHostAttributeId($hostAttributeId);
        $mapEntity->setHostAttributeMapValue($valueEntity->getHostAttributeValueName());
        
        $mapEntity = $this->mapper->save($mapEntity);
        
        return $mapEntity;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::saveText()
     */
    public function saveText($hostId, $hostAttributeId, $hostAttributeMapValue)
    {
       
        
        $mapEntity = new MapEntity();
        
        $mapEntity->setHostId($hostId);
        $mapEntity->setHostAttributeId($hostAttributeId);
        $mapEntity->setHostAttributeMapValue($hostAttributeMapValue);
       
        
        $mapEntity = $this->mapper->save($mapEntity);
        
        return $mapEntity;
    }
    
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttributeMap\Service\MapServiceInterface::delete()
     */
    public function delete(MapEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::saveWorkstation()
     */
    public function saveWorkstation($hostId, $postData)
    {
        // save operating system
        $this->mapService->saveOperatingSystem($hostId, $postData);
        
        // save manufacture
        $this->mapService->saveManufacture($hostId, $postData);
        
        // save model
        $this->mapService->saveModel($hostId, $postData);
        
        // save Asset Tag
        $this->mapService->saveAssetTag($hostId, $postData);
        
        // save Serial Number
        $this->mapService->saveSerialNumber($hostId, $postData);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::saveServer()
     */
    public function saveServer($hostId, $postData)
    {
        // save operating system
        $this->saveOperatingSystem($hostId, $postData);
        
        // save manufacture
        $this->saveManufacture($hostId, $postData);
        
        // save model
        $this->saveModel($hostId, $postData);
        
        // save server type
        if (! empty($postData->serverTypeId)) {
            $this->mapService->saveSelect($hostId, 5, $postData->serverTypeId);
        }
        
        // save Asset Tag
        $this->saveAssetTag($hostId, $postData);
        
        // save Serial Number
        $this->saveSerialNumber($hostId, $postData);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::saveLaptop()
     */
    public function saveLaptop($hostId, $postData)
    {
        // save operating system
        $this->mapService->saveOperatingSystem($hostId, $postData);
        
        // save manufacture
        $this->mapService->saveManufacture($hostId, $postData);
        
        // save model
        $this->mapService->saveModel($hostId, $postData);
        
        // save Asset Tag
        $this->mapService->saveAssetTag($hostId, $postData);
        
        // save Serial Number
        $this->mapService->saveSerialNumber($hostId, $postData);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::saveTablet()
     */
    public function saveTablet($hostId, $postData)
    {
        // save operating system
        $this->mapService->saveManufacture($hostId, $postData);
        
        // save manufacture
        $this->mapService->saveManufacture($hostId, $postData);
        
        // save model
        $this->mapService->saveModel($hostId, $postData);
        
        // save Asset Tag
        $this->mapService->saveAssetTag($hostId, $postData);
        
        // save Serial Number
        $this->mapService->saveSerialNumber($hostId, $postData);
        
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::savePrinter()
     */
    public function savePrinter($hostId, $postData)
    {
        // save manufacture
        $this->mapService->saveManufacture($hostId, $postData);
        
        // save model
        $this->mapService->saveModel($hostId, $postData);
        
        // username
        $this->mapService->saveUsername($hostId, $postData);
        
        // password
        $this->mapService->savePassword($hostId, $postData);
        
        // save Asset Tag
        $this->mapService->saveAssetTag($hostId, $postData);
        
        // save Serial Number
        $this->mapService->saveSerialNumber($hostId, $postData);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::saveCopier()
     */
    public function saveCopier($hostId, $postData)
    {
        // save manufacture
        $this->mapService->saveManufacture($hostId, $postData);
        
        // save model
        $this->mapService->saveModel($hostId, $postData);
        
        // username
        $this->mapService->saveUsername($hostId, $postData);
        
        // password
        $this->mapService->savePassword($hostId, $postData);
        
        // save Asset Tag
        $this->mapService->saveAssetTag($hostId, $postData);
        
        // save Serial Number
        $this->mapService->saveSerialNumber($hostId, $postData);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::saveScanner()
     */
    public function saveScanner($hostId, $postData)
    {
        // save manufacture
        $this->mapService->saveManufacture($hostId, $postData);
        
        // save model
        $this->mapService->saveModel($hostId, $postData);
        
        // username
        $this->mapService->saveUsername($hostId, $postData);
        
        // password
        $this->mapService->savePassword($hostId, $postData);
        
        // save Asset Tag
        $this->mapService->saveAssetTag($hostId, $postData);
        
        // save Serial Number
        $this->mapService->saveSerialNumber($hostId, $postData);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::saveRouter()
     */
    public function saveRouter($hostId, $postData)
    {
        // save operating system
        $this->mapService->saveOperatingSystem($hostId, $postData);
        
        // save manufacture
        $this->mapService->saveManufacture($hostId, $postData);
        
        // save model
        $this->mapService->saveModel($hostId, $postData);
        
        // username
        $this->mapService->saveUsername($hostId, $postData);
        
        // password
        $this->mapService->savePassword($hostId, $postData);
        
        // save Asset Tag
        $this->mapService->saveAssetTag($hostId, $postData);
        
        // save Serial Number
        $this->mapService->saveSerialNumber($hostId, $postData);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Service\MapServiceInterface::saveSwitch()
     */
    public function saveSwitch($hostId, $postData)
    {
        // save operating system
        $this->mapService->saveOperatingSystem($hostId, $postData);
        
        // save manufacture
        $this->mapService->saveManufacture($hostId, $postData);
        
        // save model
        $this->mapService->saveModel($hostId, $postData);
        
        // username
        $this->mapService->saveUsername($hostId, $postData);
        
        // password
        $this->mapService->savePassword($hostId, $postData);
        
        // save Asset Tag
        $this->mapService->saveAssetTag($hostId, $postData);
        
        // save Serial Number
        $this->mapService->saveSerialNumber($hostId, $postData);
    }
    /**
     *
     * @param number $hostId
     * @param unknown $postData
     */
    private function saveOperatingSystem($hostId, $postData)
    {
        if (! empty($postData->newOperatingSystemId)) {
            $this->saveSelect($hostId, 1, $postData->newOperatingSystemId);
        } else {
            $this->saveSelect($hostId, 1, $postData->operatingSystemId);
        }
    }
    
    /**
     *
     * @param number $hostId
     * @param unknown $postData
     */
    private function saveManufacture($hostId, $postData)
    {
        if (! empty($postData->newManufactureId)) {
            $this->saveSelect($hostId, 2, $postData->newManufactureId);
        } else {
            $this->saveSelect($hostId, 2, $postData->manufactureId);
        }
    }
    
    /**
     *
     * @param number $hostId
     * @param unknown $postData
     */
    private function saveModel($hostId, $postData)
    {
        if (! empty($postData->modelId)) {
            $this->saveText($hostId, 3, $postData->modelId);
        }
    }
    
    /**
     *
     * @param unknown $hostId
     * @param unknown $postData
     */
    public function saveUsername($hostId, $postData)
    {
        if (! empty($postData->username)) {
            $this->saveText($hostId, 6, $postData->username);
        }
    }
    
    /**
     *
     * @param number $hostId
     * @param unknown $postData
     * @throws \Exception
     */
    private function savePassword($hostId, $postData)
    {
        // make sure we have an encryption key
        if (! array_key_exists('encryption-key', $this->config) || empty($this->config['encryption-key'])) {
            throw new \Exception('missing encryption-key. You need to add the config key in the local.php config and provide a random string for default encryption');
        }
    
        if (! empty($postData->password)) {
    
            // encrypt password
            $blockCipher = BlockCipher::factory('mcrypt', array(
                'algo' => 'aes'
            ));
    
            // set key
            $blockCipher->setKey($this->config['encryption-key']);
    
            $password = $blockCipher->encrypt($postData->password);
    
            $this->saveText($hostId, 7, $password);
        }
    }
    
    /**
     *
     * @param number $hostId
     * @param unknown $postData
     */
    private function saveAssetTag($hostId, $postData)
    {
        if (! empty($postData->assetTagId)) {
            $this->saveText($hostId, 10, $postData->assetTagId);
        }
    }
    
    /**
     *
     * @param number $hostId
     * @param unknown $postdata
     */
    private function saveSerialNumber($hostId, $postData)
    {
        if (! empty($postData->serialNumberId)) {
            $this->saveText($hostId, 11, $postData->serialNumberId);
        }
    }
}