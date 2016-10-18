<?php
namespace Panorama\Service;

use Config\Service\ConfigServiceInterface;
use Panorama\Entity\DeviceEntity;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class DeviceService extends PanoramaService implements DeviceServiceInterface
{

    /**
     *
     * @var DeviceEntity
     */
    protected $prototype;

    /**
     *
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     *
     * @var Memcached
     */
    protected $memcached;

    /**
     *
     * @param ConfigServiceInterface $configService            
     * @param string $encryptionKey            
     * @param DeviceEntity $prototype            
     * @param HydratorInterface $hydrator            
     * @param Memcached $memcached            
     */
    public function __construct(ConfigServiceInterface $configService, $encryptionKey, DeviceEntity $prototype, HydratorInterface $hydrator, Memcached $memcached)
    {
        $this->prototype = $prototype;
        
        $this->hydrator = $hydrator;
        
        $this->memcached = $memcached;
        
        parent::__construct($configService, $encryptionKey);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getComputers()
     */
    public function getComputers($cid)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/devices/computers');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getServers()
     */
    public function getServers($cid)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/devices/servers');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getPrinters()
     */
    public function getPrinters($cid)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/devices/printers');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getSwitches()
     */
    public function getSwitches($cid)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/devices/switches');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getNas()
     */
    public function getNas($cid)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/devices/nas');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getUps()
     */
    public function getUps($cid)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/devices/ups');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getDevices()
     */
    public function getDevices($cid)
    {
        $key = 'panorama-getDevices-' . $cid;
        
        $data = $this->memcached->getItem($key);
        
        if (! $data) {
            
            $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/devices');
            
            $this->request->setMethod('GET');
            
            $response = $this->send();
            
            // if we have a success
            if ($response->isSuccess()) {
                $data = json_decode($response->getBody(), true);
                
                $this->memcached->setItem($key, $data);
            } else {
                $this->getError($response);
            }
        }
        
        $result = $this->hydratingResultSet($data);
        
        return $result;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getDevice()
     */
    public function getDevice($cid, $id)
    {
        $key = 'panorama-getDevice-' . $id;
        
        $data = $this->memcached->getItem($key);
        
        if (! $data) {
            $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/devices/' . $id);
            
            $this->request->setMethod('GET');
            
            $response = $this->send();
            
            // if we have a success
            if ($response->isSuccess()) {
                $data = json_decode($response->getBody(), true);
                
                $this->memcached->setItem($key, $data);
            } else {
                $this->getError($response);
            }
        }
        
        $result = $this->hydrator->hydrate($data, clone $this->prototype);
        
        return $result;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getServices()
     */
    public function getServices($id)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/devices/' . $id . '/services');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getSystemEvents()
     */
    public function getSystemEvents($id, $period)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/devices/' . $id . '/system-events/' . $period);
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getUsageData()
     */
    public function getUsageData($id, $period)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/devices/' . $id . '/usage/' . $period);
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::remoteManageService()
     */
    public function remoteManageService($id)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/devices/' . $id . '/remote-control/services');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::rebootDevice()
     */
    public function rebootDevice($id)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/devices/' . $id . '/remote-control/power');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\DeviceServiceInterface::getLocation()
     */
    public function getLocation($cid)
    {
        $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/devices/location');
        
        $this->request->setMethod('GET');
        
        $response = $this->send();
        
        // if we have a success
        if ($response->isSuccess()) {
            $data = json_decode($response->getBody(), true);
            
            $result = $this->hydratingResultSet($data);
            
            return $result;
        } else {
            $this->getError($response);
        }
    }
}
