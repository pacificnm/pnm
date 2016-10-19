<?php
namespace PanoramaHost\Service;

use PanoramaHost\Entity\PanoramaHostEntity;
use PanoramaHost\Mapper\MysqlMapperInterface;

class PanoramaHostService implements PanoramaHostServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param MysqlMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaHost\Service\PanoramaHostServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaHost\Service\PanoramaHostServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaHost\Service\PanoramaHostServiceInterface::getByDeviceId()
     */
    public function getByDeviceId($deviceId)
    {
        return $this->mapper->getByDeviceId($deviceId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaHost\Service\PanoramaHostServiceInterface::getByHostId()
     */
    public function getByHostId($hostId)
    {
        return $this->mapper->getByHostId($hostId);
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaHost\Service\PanoramaHostServiceInterface::save()
     */
    public function save(PanoramaHostEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaHost\Service\PanoramaHostServiceInterface::createPanoramaHost()
     */
    public function createPanoramaHost($hostId, $panoramaDeviceId)
    {
        $entity = new PanoramaHostEntity();
        
        $entity->setPanoramaHostId(0);
        
        $entity->setHostId($hostId);
        
        $entity->setPanoramaDeviceId($panoramaDeviceId);
        
        $entity->setPanoramaHostLastSync(time());
        
        return $this->save($entity);
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaHost\Service\PanoramaHostServiceInterface::delete()
     */
    public function delete(PanoramaHostEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}