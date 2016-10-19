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
use Panorama\Entity\Ipv4Entity;

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
        if(array_key_exists('cpu', $data)) {
            $cpuEntity = parent::hydrate($data["cpu"], new CpuEntity());
            
            $object->setCpuEntity($cpuEntity);
        } else {
            $object->setCpuEntity(new CpuEntity());
        }
        
        // disksEntity
        if(array_key_exists('disks', $data) && $data['disks'][0]) {
            $disksEntity = parent::hydrate($data['disks'][0], new DisksEntity());
            
            $object->setDisksEntity($disksEntity);
        } else {
            $object->setDisksEntity(new DisksEntity());
        }
        
        
        
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
        if(array_key_exists('asset_state', $data)) {
            $assetStateEntity = parent::hydrate($data['asset_state'], new AssetStateEntity());
        } else {
            $assetStateEntity = new AssetStateEntity();
        }
        
        
        $object->setAssetStateEntity($assetStateEntity);
        
        // locationEntity
        $locationEntity = parent::hydrate($data, new LocationEntity());
        
        $object->setLocationEntity($locationEntity);
        
        // networkEntity
        //\Zend\Debug\Debug::dump($data['network']); die;
        if(array_key_exists('network', $data)) {
            if (count($data['network']) == count($data['network'], COUNT_RECURSIVE)) {
                $networkEntity = parent::hydrate($data['network'], new NetworkEntity());
            } else {
                $networkEntity = parent::hydrate($data['network'][0], new NetworkEntity());
            }
            
        } else {
            $networkEntity = new NetworkEntity();
        }
       
        
        $object->setNetworkEntity($networkEntity);
        
        // ipEntity
        if($data['network'][0]['ipv4'][0]) {
            $ipv4Entity = parent::hydrate($data['network'][0]['ipv4'][0], new Ipv4Entity());
        
            $object->getNetworkEntity()->setIpv4Entity($ipv4Entity);
        } else {
            $object->getNetworkEntity()->setIpv4Entity(new Ipv4Entity());
        }
        
        // userEntity
        $userEntity = parent::hydrate($data, new UserEntity());
        
        $object->setUserEntity($userEntity);
        
        // remoteControlEntity
        if(array_key_exists('remote_control', $data)) {
            $remoteControlEntity = array();
            
            foreach($data['remote_control'] as $array) {
                
                $remoteControlEntity[] = parent::hydrate($array, new RemoteControlEntity());
            }
        } else {
            $remoteControlEntity = new RemoteControlEntity();
        }
        
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