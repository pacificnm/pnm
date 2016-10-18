<?php
namespace Panorama\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Panorama\Entity\DeviceEntity;
use Panorama\Entity\CpuEntity;
use Panorama\Entity\DisksEntity;
use Panorama\Entity\PartitionsEntity;
use Panorama\Entity\VideoEntity;
use Panorama\Entity\AudioEntity;
use Panorama\Entity\AssetStateEntity;
use Panorama\Entity\LocationEntity;
use Panorama\Entity\NetworkEntity;
use Panorama\Entity\UserEntity;
use Panorama\Entity\RemoteControlEntity;
use Panorama\Entity\ViewsEntity;
use Panorama\Entity\ImagesEntity;

class DeviceHydrator extends ClassMethods
{

    /**
     *
     * @param string $underscoreSeparatedKeys            
     */
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::hydrate()
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof DeviceEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        // cpu
        $cpuEntity = parent::hydrate($data, new CpuEntity());
        
        $object->setCpuEntity($cpuEntity);
        
        // disksEntity
        $disksEntity = parent::hydrate($data, new DisksEntity());
        
        $object->setDisksEntity($disksEntity);
        
        // partitionsEntity
        $partitionsEntity = parent::hydrate($data, new PartitionsEntity());
        
        $object->setPartitionsEntity($partitionsEntity);
        
        // videoEntity
        $videoEntity = parent::hydrate($data, new VideoEntity());
        
        $object->setVideoEntity($videoEntity);
        
        // audioEntity
        $audioEntity = parent::hydrate($data, new AudioEntity());
        
        $object->setAudioEntity($audioEntity);
        
        // assetStateEntity
        $assetStateEntity = parent::hydrate($data, new AssetStateEntity());
        
        $object->setAssetStateEntity($assetStateEntity);
        
        // locationEntity
        $locationEntity = parent::hydrate($data, new LocationEntity());
        
        $object->setLocationEntity($locationEntity);
        
        // networkEntity
        $networkEntity = parent::hydrate($data, new NetworkEntity());
        
        $object->setNetworkEntity($networkEntity);
        
        // userEntity
        $userEntity = parent::hydrate($data, new UserEntity());
        
        $object->setUserEntity($userEntity);
        
        // remoteControlEntity
        $remoteControlEntity = parent::hydrate($data, new RemoteControlEntity());
        
        $object->setRemoteControlEntity($remoteControlEntity);
        
        // viewsEntity
        $viewsEntity = parent::hydrate($data, new ViewsEntity());
        
        $object->setViewsEntity($viewsEntity);
        
        // imagesEntity
        $imagesEntity = parent::hydrate($data['images'], new ImagesEntity());
        
        $object->setImagesEntity($imagesEntity);
        
        return $object;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::extract()
     */
    public function extract($object)
    {
        if (! $object instanceof DeviceEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        return $data;
    }
}