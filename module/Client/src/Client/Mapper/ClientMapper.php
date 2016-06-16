<?php
namespace Client\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use Client\Entity\ClientEntity;
use Zend\Db\Sql\Expression;

class ClientMapper implements ClientMapperInterface
{

    /**
     *
     * @var AdapterInterface
     */
    protected $readAdapter;

    /**
     *
     * @var AdapterInterface
     */
    protected $writeAdapter;

    /**
     *
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     *
     * @var EmployeeEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param ClientEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, ClientEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
        
        $this->writeAdapter = $writeAdapter;
        
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Mapper\ClientMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client');
        
        // clientStatus
        if (array_key_exists('clientStatus', $filter) && ! empty($filter['clientStatus'])) {
            $select->where(array(
                'client.client_status =? ' => $filter['clientStatus']
            ));
        }
        
        // keyword
        if (array_key_exists('keyword', $filter) && ! empty($filter['keyword'])) {
            if (is_numeric($filter['keyword'])) {
                $select->where(array(
                    'client.client_id = ?' => $filter['keyword']
                ));
            } else {
                $select->where->like('client.client_name', $filter['keyword'] . "%");
            }
        }
        
        // join location
        $expresion = new Expression("client.client_id = location.client_id  AND location.location_type='Primary' AND location.location_status='Active'");
        
        $select->join('location', $expresion, array(
            'location_type',
            'location_street',
            'location_city',
            'location_state',
            'location_zip',
            'location_Status'
        ), 'left');
        
        // join phone
        $expresion = new Expression("location.location_id = phone.location_id AND phone.phone_type='Primary'");
        
        $select->join('phone', $expresion, array(
            'phone_type',
            'phone_num'
        ), 'left');
        
        $select->order('client.client_name');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Mapper\ClientMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client');
        
        // join location
        $expresion = new Expression("client.client_id = location.client_id  AND location.location_type='Primary' AND location.location_status='Active'");
        
        $select->join('location', $expresion, array(
            'location_type',
            'location_street',
            'location_city',
            'location_state',
            'location_zip',
            'location_Status'
        ), 'left');
        
        // join phone
        $expresion = new Expression("location.location_id = phone.location_id AND phone.phone_type='Primary'");
        
        $select->join('phone', $expresion, array(
            'phone_type',
            'phone_num'
        ), 'left');
        
        $select->where(array(
            'client.client_id = ?' => $id
        ));
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
            
            $resultSet->buffer();
            
            return $resultSet->initialize($result)->current();
        }
        
        return array();
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
            
            // ID present, it's an Update
            $action = new Update('client');
            
            $action->set($postData);
            
            $action->where(array(
                'client.client_id = ?' => $entity->getClientId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('client');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setClientId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Mapper\ClientMapperInterface::delete()
     */
    public function delete(ClientEntity $entity)
    {
        $action = new Delete('client');
        
        $action->where(array(
            'client.client_id = ?' => $entity->getClientId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}
