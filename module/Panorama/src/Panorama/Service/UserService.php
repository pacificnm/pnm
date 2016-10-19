<?php
namespace Panorama\Service;

use Panorama\Entity\UserEntity;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Config\Service\ConfigServiceInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class UserService extends PanoramaService implements UserServiceInterface
{

    /**
     *
     * @var UserEntity
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
     * @param UserEntity $prototype            
     * @param HydratorInterface $hydrator            
     * @param Memcached $memcached            
     */
    public function __construct(ConfigServiceInterface $configService, $encryptionKey, UserEntity $prototype, HydratorInterface $hydrator, Memcached $memcached)
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
     * @see \Panorama\Service\UserServiceInterface::getUser()
     */
    public function getUser($cid, $id)
    {
        $key = 'panorama-getUsers-' . $cid . '-' . $id;
        
        $data = $this->memcached->getItem($key);
        
        if (! $data) {
            
            $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/users/' . $id);
            
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
     * @see \Panorama\Service\UserServiceInterface::getUsers()
     */
    public function getUsers($cid)
    {
        $key = 'panorama-getUsers-' . $cid;
        
        $data = $this->memcached->getItem($key);
        
        
        if (! $data) {
            
            $this->request->setUri('https://dashboard.panorama9.com/api/' . $cid . '/users');
            
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
}
