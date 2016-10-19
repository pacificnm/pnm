<?php
namespace PanoramaClient\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use PanoramaClient\Entity\PanoramaClientEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param PanoramaClientEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, PanoramaClientEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaClient\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('panorama_client');
        
        $this->filter($filter)->joinClient();
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaClient\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('panorama_client');
        
        $this->select->where(array(
            'panorama_client.panorama_client_id = ?' => $id
        ));
        
        $this->joinClient();
        
        return $this->getRow();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PanoramaClient\Mapper\MysqlMapperInterface::getByCid()
     */
    public function getByCid($cid)
    {
        $this->select = $this->readSql->select('panorama_client');
        
        $this->select->where(array(
            'panorama_client.panorama_client_cid = ?' => $cid
        ));
        
        $this->joinClient();
        
        return $this->getRow();
    }
    
    public function getByClientId($clientId)
    {
        $this->select = $this->readSql->select('panorama_client');
        
        $this->select->where(array(
            'panorama_client.client_id = ?' => $clientId
        ));
        
        $this->joinClient();
        
        return $this->getRow();
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaClient\Mapper\MysqlMapperInterface::save()
     */
    public function save(PanoramaClientEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getPanoramaClientId()) {
            $this->update = new Update('panorama_client');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'panorama_client.panorama_client_id = ?' => $entity->getPanoramaClientId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('panorama_client');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setPanoramaClientId($id);
        }
        
        return $this->get($entity->getPanoramaClientId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PanoramaClient\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(PanoramaClientEntity $entity)
    {
        $this->delete = new Delete('panorama_client');
        
        $this->delete->where(array(
            'panorama_client.panorama_client_id = ?' => $entity->getPanoramaClientId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @return \PanoramaClient\Mapper\MysqlMapper
     */
    protected function joinClient()
    {
        $this->select->join('client', 'client.client_id = panorama_client.client_id', array(
            'client_name',
            'client_status'
        ), 'inner');
        
        return $this;
    }

    /**
     *
     * @param unknown $filter            
     * @return \PanoramaClient\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }
}
