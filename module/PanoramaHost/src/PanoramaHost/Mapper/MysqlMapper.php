<?php
namespace PanoramaHost\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use PanoramaHost\Entity\PanoramaHostEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param PanoramaHostEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, PanoramaHostEntity $prototype)
    {
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
    
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaHost\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('panorama_host');
        
        $this->filter($filter)->joinHost();
        
        return $this->getPaginator();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaHost\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('panorama_host');
        
        $this->joinHost();
        
        $this->select->where(array(
            'panorama_host.panorama_host_id = ?' => $id
        ));
        
        return $this->getRow();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaHost\Mapper\MysqlMapperInterface::getByDeviceId()
     */
    public function getByDeviceId($deviceId)
    {
        $this->select = $this->readSql->select('panorama_host');
        
        $this->joinHost();
        
        $this->select->where(array(
            'panorama_host.panorama_device_id = ?' => $deviceId
        ));
        
        return $this->getRow();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaHost\Mapper\MysqlMapperInterface::getByHostId()
     */
    public function getByHostId($hostId)
    {
        
        $this->select = $this->readSql->select('panorama_host');
        
        $this->joinHost();
        
        $this->select->where(array(
            'panorama_host.host_id = ?' => $hostId
        ));
        
        
        return $this->getRow();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaHost\Mapper\MysqlMapperInterface::save()
     */
    public function save(PanoramaHostEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getPanoramaHostId()) {
            $this->update = new Update('panorama_host');
        
            $this->update->set($postData);
        
            $this->update->where(array(
                'panorama_host.panorama_host_id = ?' => $entity->getPanoramaHostId()
            ));
        
            $this->updateRow();
        } else {
            $this->insert = new Insert('panorama_host');
        
            $this->insert->values($postData);
        
            $id = $this->createRow();
        
            $entity->setPanoramaHostId($id);
        }
        
        return $this->get($entity->getPanoramaHostId());
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaHost\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(PanoramaHostEntity $entity)
    {
        $this->delete = new Delete('panorama_host');
        
        $this->delete->where(array(
            'panorama_host.panorama_host_id = ?' => $entity->getPanoramaHostId()
        ));
        
        return $this->deleteRow();
    }
    
    /**
     * 
     * @param array $filter
     * @return \PanoramaHost\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }
    
    /**
     * 
     * @return \PanoramaHost\Mapper\MysqlMapper
     */
    protected function joinHost()
    {
        return $this;
    }
}

?>