<?php
namespace Host\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use Host\Entity\HostEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param HostEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, HostEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('host');
        
        $this->filter($filter)
            ->joinHostType()
            ->joinLocation();
        
        $this->select->where(array(
            'host.host_status != ?' => 'Deleted'
        ));
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('host');
        
        $this->joinHostType()->joinLocation();
        
        $this->select->where(array(
            'host.host_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Mapper\MysqlMapperInterface::save()
     */
    public function save(HostEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getHostId()) {
            $this->update = new Update('host');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'host.host_id = ?' => $entity->getHostId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('host');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setHostId($id);
        }
        
        return $this->get($entity->getHostId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(HostEntity $entity)
    {
        $this->delete = new Delete('host');
        
        $this->delete->where(array(
            'host.host_id = ?' => $entity->getHostId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Mapper\MysqlMapperInterface::getClientHostNotInWorkorder()
     */
    public function getClientHostNotInWorkorder($clientId, $workorderId)
    {
        $this->select = $this->readSql->select('host');
        
        $this->joinHostType()->joinLocation();
        
        $this->select->where(array(
            'host.host_status != ?' => 'Deleted'
        ));
        
        $this->select->where(array(
            'host.client_id = ?' => $clientId
        ));
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Mapper\MysqlMapperInterface::getClientHosts()
     */
    public function getClientHosts($clientId)
    {
        $this->select = $this->readSql->select('host');
        
        $this->joinHostType()->joinLocation();
        
        $this->select->where(array(
            'host.host_status != ?' => 'Deleted'
        ));
        
        $this->select->where(array(
            'host.client_id = ?' => $clientId
        ));
        
        return $this->getRows();
    }

    /**
     *
     * @param array $filter            
     * @return \Host\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        // client id
        if (array_key_exists('clientId', $filter) && ! empty($filter['clientId'])) {
            $this->select->where(array(
                'host.client_Id = ?' => $filter['clientId']
            ));
        }
        
        // host status
        if (array_key_exists('hostStatus', $filter) && ! empty($filter['hostStatus'])) {
            $this->select->where(array(
                'host.host_status = ?' => $filter['hostStatus']
            ));
        }
        
        // host type
        if (array_key_exists('hostTypeId', $filter) && ! empty($filter['hostTypeId'])) {
            $this->select->where(array(
                'host.host_type_id = ?' => $filter['hostTypeId']
            ));
        }
        
        // keyword
        if (array_key_exists('keyword', $filter) && ! empty($filter['keyword'])) {
            $this->select->where->like('host.host_name', $filter['keyword'] . '%');
        }
        
        return $this;
    }

    /**
     *
     * @return \Host\Mapper\MysqlMapper
     */
    protected function joinHostType()
    {
        // join host type
        $this->select->join('host_type', 'host.host_type_id = host_type.host_type_id', array(
            'host_type_name'
        ), 'inner');
        
        return $this;
    }

    /**
     * 
     * @return \Host\Mapper\MysqlMapper
     */
    protected function joinLocation()
    {
        // join location
        $this->select->join('location', 'host.location_id = location.location_id', array(
            'location_type',
            'location_street',
            'location_street_cont',
            'location_city',
            'location_state',
            'location_zip',
            'location_Status'
        ), 'inner');
        
        return $this;
    }
}