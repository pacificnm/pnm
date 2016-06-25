<?php
namespace AclResource\Service;

use Zend\Cache\Storage\Adapter\Memcached;
use AclResource\Entity\ResourceEntity;
use AclResource\Mapper\ResourceMapperInterface;

class ResourceService implements ResourceServiceInterface
{
    /**
     * 
     * @var ResourceMapperInterface
     */
    protected $mapper;

    /**
     *
     * @var Memcached
     */
    protected $memcached;
    
    /**
     * 
     * @param ResourceMapperInterface $mapper
     * @param Memcached $memcached
     */
    public function __construct(ResourceMapperInterface $mapper,  Memcached $memcached)
    {
        $this->mapper = $mapper;
        
        $this->memcached = $memcached;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AclResource\Service\ResourceServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        if(array_key_exists('pagination', $filter) && $filter['pagination'] == 'off') {
            
            $key = 'acl-resource-get-all';
            
            $resourceEntitys = $this->memcached->getItem($key);
            
            if(! $resourceEntitys) {
                $resourceEntitys = $this->mapper->getAll($filter);
                
                $this->memcached->setItem($key, $resourceEntitys);
               
            }
            
            return $resourceEntitys;
        }
        
        
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AclResource\Service\ResourceServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AclResource\Service\ResourceServiceInterface::getReource()
     */
    public function getReource($resource)
    {
        return $this->mapper->getReource($resource);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AclResource\Service\ResourceServiceInterface::save()
     */
    public function save(ResourceEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AclResource\Service\ResourceServiceInterface::delete()
     */
    public function delete(ResourceEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}