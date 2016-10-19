<?php
namespace Client\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Client\Entity\ClientEntity;
use Zend\Db\Sql\Expression;
use Application\Mapper\CoreMysqlMapper;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param ClientEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, ClientEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Mapper\ClientMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('client');
        
        $this->filter($filter)
            ->joinLocation()
            ->joinPhone();
        
        $this->select->order('client.client_name');
        
        $this->select->group('client.client_id');
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Mapper\ClientMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('client');
        
        $this->joinLocation()->joinPhone();
        
        $this->select->where(array(
            'client.client_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Mapper\MysqlMapperInterface::getClientByName()
     */
    public function getClientByName($clientName)
    {
        $this->select = $this->readSql->select('client');
        
        $this->select->where(array(
            'client.client_name = ?' => $clientName
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Mapper\ClientMapperInterface::save()
     */
    public function save(ClientEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getClientId()) {
            
            $this->update = new Update('client');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'client.client_id = ?' => $entity->getClientId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('client');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setClientId($id);
        }
        
        return $this->get($entity->getClientId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Mapper\MysqlMapperInterface::createClient()
     */
    public function createClient($clientName, $clientStatus)
    {
        $entity = new ClientEntity();
        
        $entity->setClientCreated(time());
        
        $entity->setClientId(0);
        
        $entity->setClientName($clientName);
        
        $entity->setClientStatus($clientStatus);
        
        return $this->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Mapper\ClientMapperInterface::delete()
     */
    public function delete(ClientEntity $entity)
    {
        $this->delete = new Delete('client');
        
        $this->delete->where(array(
            'client.client_id = ?' => $entity->getClientId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \Client\Mapper\ClientMapper
     */
    protected function filter($filter)
    {
        // clientStatus
        if (array_key_exists('clientStatus', $filter) && ! empty($filter['clientStatus'])) {
            $this->select->where(array(
                'client.client_status =? ' => $filter['clientStatus']
            ));
        }
        
        // keyword
        if (array_key_exists('keyword', $filter) && ! empty($filter['keyword'])) {
            if (is_numeric($filter['keyword'])) {
                $this->select->where(array(
                    'client.client_id = ?' => $filter['keyword']
                ));
            } else {
                $this->select->where->like('client.client_name', $filter['keyword'] . "%");
            }
        }
        
        return $this;
    }

    /**
     *
     * @return \Client\Mapper\ClientMapper
     */
    protected function joinLocation()
    {
        // join location
        $expresion = new Expression("client.client_id = location.client_id  AND location.location_type='Primary' AND location.location_status='Active'");
        
        $this->select->join('location', $expresion, array(
            'location_id',
            'location_type',
            'location_street',
            'location_city',
            'location_state',
            'location_zip',
            'location_Status'
        ), 'left');
        
        return $this;
    }

    /**
     *
     * @return \Client\Mapper\ClientMapper
     */
    protected function joinPhone()
    {
        // join phone
        $expresion = new Expression("location.location_id = phone.location_id AND phone.phone_type='Primary'");
        
        $this->select->join('phone', $expresion, array(
            'phone_id',
            'phone_type',
            'phone_num'
        ), 'left');
        
        return $this;
    }
}
