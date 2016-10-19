<?php
namespace PanoramaClient\Service;

use PanoramaClient\Entity\PanoramaClientEntity;
use PanoramaClient\Mapper\MysqlMapperInterface;

class PanoramaClientService implements PanoramaClientServiceInterface
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
     * @see \PanoramaClient\Service\PanoramaClientServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaClient\Service\PanoramaClientServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaClient\Service\PanoramaClientServiceInterface::getByCid()
     */
    public function getByCid($cid)
    {
        return $this->mapper->getByCid($cid);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaClient\Service\PanoramaClientServiceInterface::getByClientId()
     */
    public function getByClientId($clientId)
    {
        return $this->mapper->getByClientId($clientId);
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaClient\Service\PanoramaClientServiceInterface::save()
     */
    public function save(PanoramaClientEntity $entity)
    {
        return $this->mapper->save($entity);
    }
    
    public function create($clientId, $panoramaClientCid)
    {
        $entity = new PanoramaClientEntity();
        
        $entity->setClientId($clientId);
        
        $entity->setPanoramaClientCid($panoramaClientCid);
        
        $entity->setPanoramaClientId(0);
        
        $entity->setPanoramaClientLastSync(time());
        
        return $this->save($entity);
        
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaClient\Service\PanoramaClientServiceInterface::delete()
     */
    public function delete(PanoramaClientEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}