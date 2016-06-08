<?php
namespace Config\Service;

use Zend\Cache\Storage\Adapter\Memcached;
use Config\Entity\ConfigEntity;
use Config\Mapper\ConfigMapperInterface;

class ConfigService implements ConfigServiceInterface
{

    /**
     *
     * @var ConfigMapperInterface
     */
    protected $mapper;

    /**
     * 
     * @var Memcached
     */
    protected $memcached;

    /**
     *
     * @param ConfigMapperInterface $mapper            
     * @param Memcached $memcached            
     */
    public function __construct(ConfigMapperInterface $mapper, Memcached $memcached)
    {
        $this->mapper = $mapper;
        
        $this->memcached = $memcached;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Config\Service\ConfigServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Config\Service\ConfigServiceInterface::get()
     */
    public function get($id)
    {
        $key = 'config-service-get-' . $id;
        
        $configEntity = $this->memcached->getItem($key);
        
        if (! $configEntity) {
            
            $configEntity = $this->mapper->get($id);
            
            $this->memcached->setItem($key, $configEntity);
        }
        
        return $configEntity;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Config\Service\ConfigServiceInterface::save()
     */
    public function save(ConfigEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Config\Service\ConfigServiceInterface::delete()
     */
    public function delete(ConfigEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}