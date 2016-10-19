<?php
namespace Panorama\Service;

use Config\Service\ConfigServiceInterface;
use Panorama\Entity\MspEntity;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class MspService extends PanoramaService implements MspServiceInterface
{

    /**
     *
     * @var MspEntity
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
     * @param memcached $encryptionKey            
     * @param MspEntity $prototype            
     * @param HydratorInterface $hydrator            
     * @param Memcached $memcached            
     */
    public function __construct(ConfigServiceInterface $configService, $encryptionKey, MspEntity $prototype, HydratorInterface $hydrator, Memcached $memcached)
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
     * @see \Panorama\Service\MspServiceInterface::getClientsSummary()
     */
    public function getClientsSummary()
    {
        $key = 'panorama-getClientsSummary';
        
        $data = $this->memcached->getItem($key);
        
        if (! $data) {
            $this->request->setUri('https://dashboard.panorama9.com/api/msp/summary');
            
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
     * @see \Panorama\Service\MspServiceInterface::getClient()
     */
    public function getClient($id)
    {
        $key = 'panorama-getCLient-' . $id;
        
        $data = $this->memcached->getItem($key);
        
        if (! $data) {
            $this->request->setUri('https://dashboard.panorama9.com/api/msp/clients/' . $id);
            
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
     * @see \Panorama\Service\MspServiceInterface::getClients()
     */
    public function getClients()
    {
        $key = 'panorama-getClients';
        
        $data = $this->memcached->getItem($key);
        
        if (! $data) {
            $this->request->setUri('https://dashboard.panorama9.com/api/msp/clients');
            
            $this->request->setMethod('GET');
            
            $response = $this->send();
            
            // if we have a success
            if ($response->isSuccess()) {
                $data = json_decode($response->getBody(), true);
                
                $this->memcached->setItem($key, $data);
                
                echo 'cached ' . $key . ' ';
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
     * @see \Panorama\Service\MspServiceInterface::createClient()
     */
    public function createClient($name, $location)
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\MspServiceInterface::updateCLient()
     */
    public function updateCLient()
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\MspServiceInterface::deleteClient()
     */
    public function deleteClient($id)
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\MspServiceInterface::getCurrentSnoozeStatus()
     */
    public function getCurrentSnoozeStatus()
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\MspServiceInterface::setSnoozePeriod()
     */
    public function setSnoozePeriod($for)
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\MspServiceInterface::Unsnooze()
     */
    public function Unsnooze()
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\MspServiceInterface::getAllUsers()
     */
    public function getAllUsers()
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Panorama\Service\MspServiceInterface::getAllTemplates()
     */
    public function getAllTemplates()
    {
        // TODO Auto-generated method stub
    }
}

?>