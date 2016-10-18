<?php
namespace Workorder\Mapper;

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
use Zend\Db\ResultSet\ResultSet;
use Workorder\Entity\WorkorderEntity;
use Zend\Db\Sql\Expression;

class WorkorderMapper implements WorkorderMapperInterface
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
     * @var WorkorderEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param WorkorderEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, WorkorderEntity $prototype)
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
     * @see \Workorder\Mapper\WorkorderMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        // client id
        if (array_key_exists('clientId', $filter) && ! empty($filter['clientId'])) {
            $select->where(array(
                'workorder.client_Id = ?' => $filter['clientId']
            ));
        }
        
        // workorder status
        if (array_key_exists('workorderStatus', $filter) && ! empty($filter['workorderStatus'])) {
            $select->where(array(
                'workorder.workorder_status = ?' => $filter['workorderStatus']
            ));
        }
        
        // keyword
        if (array_key_exists('keyword', $filter) && ! empty($filter['keyword'])) {
            if (is_numeric($filter['keyword'])) {
                $select->where(array(
                    'workorder.workorder_id = ?' => $filter['keyword']
                ));
            } else {
                $select->where->like('workorder.workorder_description', $filter['keyword'] . "%");
            }
        }
        
        // join location
        $select->join('location', 'workorder.location_id = location.location_id', array(
            'location_type',
            'location_street',
            'location_street_cont',
            'location_city',
            'location_state',
            'location_zip',
            'location_Status'
        ), 'left');
        
        // join phone
        $select->join('phone', 'location.location_id = phone.phone_id', array(
            'phone_type',
            'phone_num'
        ), 'left');
        
        // join primary user
        $exspresion = new Expression("location.location_id = user.location_id AND user.user_type = 'Primary' AND user.user_status = 'Active'");
        $select->join('user', $exspresion, array(
            'user_status',
            'user_name_first',
            'user_name_last',
            'user_job_title',
            'user_email',
            'user_type'
        ), 'left');
        
        // join client
        $select->join('client', 'workorder.client_id = client.client_id', array(
            'client_name',
            'client_status'
        ), 'inner');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Mapper\WorkorderMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        $select->where(array(
            'workorder.workorder_id = ?' => $id
        ));
        
        // join location
        $select->join('location', 'workorder.location_id = location.location_id', array(
            'location_type',
            'location_street',
            'location_city',
            'location_state',
            'location_zip',
            'location_Status'
        ), 'left');
        
        // join phone
        $select->join('phone', 'location.location_id = phone.phone_id', array(
            'phone_type',
            'phone_num'
        ), 'left');
        
        // join user
        $exspresion = new Expression("location.location_id = user.location_id AND user.user_type = 'Primary' AND user.user_status = 'Active'");
        $select->join('user', $exspresion, array(
            'user_status',
            'user_name_first',
            'user_name_last',
            'user_job_title',
            'user_email',
            'user_type'
        ), 'left');
        
        // join client
        $select->join('client', 'workorder.client_id = client.client_id', array(
            'client_name',
            'client_status'
        ), 'inner');
        
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
     * @see \Workorder\Mapper\WorkorderMapperInterface::getByDateRange()
     */
    public function getByDateRange($start, $end, $status)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        // status
        $select->where(array(
            'workorder.workorder_status = ?' => $status
        ));
        
        if ($start) {
            $select->where->greaterThanOrEqualTo('workorder.workorder_date_scheduled', $start);
        }
        
        if ($end) {
            $select->where->lessThanOrEqualTo('workorder.workorder_date_close', $end);
        }
        
        // join location
        $select->join('location', 'workorder.location_id = location.location_id', array(
            'location_type',
            'location_street',
            'location_street_cont',
            'location_city',
            'location_state',
            'location_zip',
            'location_Status'
        ), 'left');
        
        // join phone
        $select->join('phone', 'location.location_id = phone.phone_id', array(
            'phone_type',
            'phone_num'
        ), 'left');
        
        // join primary user
        $exspresion = new Expression("location.location_id = user.location_id AND user.user_type = 'Primary' AND user.user_status = 'Active'");
        $select->join('user', $exspresion, array(
            'user_status',
            'user_name_first',
            'user_name_last',
            'user_job_title',
            'user_email',
            'user_type'
        ), 'left');
        
        // join client
        $select->join('client', 'workorder.client_id = client.client_id', array(
            'client_name',
            'client_status'
        ), 'inner');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Mapper\WorkorderMapperInterface::getClientTotalCount()
     */
    public function getClientTotalCount($clientId, $status)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        $select->columns(array(
            'workorder_count' => new \Zend\Db\Sql\Expression('COUNT(*)')
        ));
        
        $select->where(array(
            'client_id = ?' => $clientId
        ));
        
        // status
        if (! empty($status)) {
            $select->where(array(
                'workorder.workorder_status = ?' => $status
            ));
        }
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new ResultSet();
            
            $resultSet->initialize($result);
            
            $row = $resultSet->current();
            
            return $row['workorder_count'];
        }
        
        return 0;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Mapper\WorkorderMapperInterface::getClientTotalLabor()
     */
    public function getClientTotalLabor($clientId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        $select->columns(array(
            'workorder_labor_total' => new \Zend\Db\Sql\Expression('SUM(workorder_labor)')
        ));
        
        $select->where(array(
            'client_id = ?' => $clientId
        ));
        
        $select->where(array(
            'workorder.workorder_status = ?' => 'Closed'
        ));
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new ResultSet();
            
            $resultSet->initialize($result);
            
            $row = $resultSet->current();
            
            return $row['workorder_labor_total'];
        }
        
        return 0;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Mapper\WorkorderMapperInterface::getWorkorderSchedule()
     */
    public function getWorkorderSchedule(array $filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        // client
        if (array_key_exists('client', $filter) && ! empty($filter['client'])) {
            $select->where(array(
                'workorder.client_id = ?' => $filter['client']
            ));
        }
        
        // employee
        if (array_key_exists('employee', $filter) && ! empty($filter['employee'])) {
            $select->join('workorder_employee', 'workorder.workorder_id = workorder_employee.workorder_id', array(), 'inner');
            $select->where(array(
                'workorder_employee.employee_id = ?' => $filter['employee']
            ));
        }
        
        // join client
        $select->join('client', 'workorder.client_id = client.client_id', array(
            'client_name',
            'client_status'
        ), 'inner');
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
            
            $resultSet->buffer();
            
            return $resultSet->initialize($result);
        }
        
        return array();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Mapper\WorkorderMapperInterface::getClientTotalPart()
     */
    public function getClientTotalPart($clientId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        $select->columns(array(
            'workorder_part_total' => new \Zend\Db\Sql\Expression('SUM(workorder_parts)')
        ));
        
        $select->where(array(
            'client_id = ?' => $clientId
        ));
        
        $select->where(array(
            'workorder.workorder_status = ?' => 'Closed'
        ));
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new ResultSet();
            
            $resultSet->initialize($result);
            
            $row = $resultSet->current();
            
            return $row['workorder_part_total'];
        }
        
        return 0;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Mapper\WorkorderMapperInterface::getClientUnInvoiced()
     */
    public function getClientUnInvoiced($clientId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        $select->where(array(
            'workorder.client_id = ?' => $clientId
        ));
        
        $select->where(array(
            'workorder.invoice_id = ?' => 0
        ));
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
            
            $resultSet->buffer();
            
            return $resultSet->initialize($result);
        }
        
        return array();
    }

    public function getInvoiceWorkorders($invoiceId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        $select->where(array(
            'workorder.invoice_id = ?' => $invoiceId
        ));
        
        // join location
        $select->join('location', 'workorder.location_id = location.location_id', array(
            'location_type',
            'location_street',
            'location_city',
            'location_state',
            'location_zip',
            'location_Status'
        ), 'left');
        
        // join phone
        $select->join('phone', 'location.location_id = phone.phone_id', array(
            'phone_type',
            'phone_num'
        ), 'left');
        
        // join primary user
        $exspresion = new Expression("location.location_id = user.location_id AND user.user_type = 'Primary' AND user.user_status = 'Active'");
        $select->join('user', $exspresion, array(
            'user_status',
            'user_name_first',
            'user_name_last',
            'user_job_title',
            'user_email',
            'user_type'
        ), 'left');
        
        // join client
        $select->join('client', 'workorder.client_id = client.client_id', array(
            'client_name',
            'client_status'
        ), 'inner');
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
            
            $resultSet->buffer();
            
            return $resultSet->initialize($result);
        }
        
        return array();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Mapper\WorkorderMapperInterface::save()
     */
    public function save(WorkorderEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getWorkorderId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder.workorder_id = ?' => $entity->getWorkorderId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setWorkorderId($newId);
            }
            
            
            
            return $this->get($entity->getWorkorderId());
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Mapper\WorkorderMapperInterface::delete()
     */
    public function delete(WorkorderEntity $entity)
    {
        $action = new Delete('workorder');
        
        $action->where(array(
            'workorder.workorder_id = ?' => $entity->getWorkorderId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}