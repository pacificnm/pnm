<?php
namespace WorkorderTime\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use WorkorderTime\Entity\TimeEntity;

class TimeMapper implements TimeMapperInterface
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
     * @var TimeEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param TimeEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, TimeEntity $prototype)
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
     * @see \WorkorderTime\Mapper\TimeMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_time');
        
        // workorderId
        if (array_key_exists('workorderId', $filter) && ! empty($filter['workorderId'])) {
            $select->where(array(
                'workorder_time.workorder_id = ?' => $filter['workorderId']
            ));
        }
        
        $select->join('employee', 'employee.employee_id = workorder_time.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_im',
            'employee_image',
            'employee_status'
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
     * @see \WorkorderTime\Mapper\TimeMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_time');
        
        $select->where(array(
            'workorder_time.workorder_time_id = ?' => $id
        ));
        
        $select->join('employee', 'employee.employee_id = workorder_time.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_im',
            'employee_image',
            'employee_status'
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
     * @see \WorkorderTime\Mapper\TimeMapperInterface::save()
     */
    public function save(TimeEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getWorkorderTimeId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder_time');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder_time.workorder_time_id = ?' => $entity->getWorkorderTimeId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder_time');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setWorkorderTimeId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderTime\Mapper\TimeMapperInterface::delete()
     */
    public function delete(TimeEntity $entity)
    {
        $action = new Delete('workorder_time');
        
        $action->where(array(
            'workorder_time.workorder_time_id = ?' => $entity->getWorkorderTimeId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderTime\Mapper\TimeMapperInterface::getTotalByLabor()
     */
    public function getTotalByLabor($clientId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_time');
        
        $select->columns(array(
            'workorder_labor_total' => new \Zend\Db\Sql\Expression('SUM(labor_total)'),
            'labor_id',
            'labor_name'
        ));
        
        $select->join('workorder', 'workorder.workorder_id = workorder_time.workorder_id', array(
            'client_id'
        ), 'inner');
        
        $select->where(array(
            'workorder.client_id = ?' => $clientId
        ));
        
        
        
        $select->group('labor_id');
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new ResultSet();
            
            $resultSet->initialize($result);
            
            $resultSet->buffer();
            
            return $resultSet;
        }
        
        return 0;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderTime\Mapper\TimeMapperInterface::getTotalByDateRange()
     */
    public function getTotalByDateRange($start, $end)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_time');
        
        $select->columns(array(
            'workorder_labor_total' => new \Zend\Db\Sql\Expression('SUM(labor_total)'),
        ));
        
        // join workorder
        $select->join('workorder', 'workorder_time.workorder_id = workorder.workorder_id', array(
            'workorder_date_scheduled',
            'workorder_date_close'
        ), 'inner');
        
                
        if ($start) {
            $select->where->greaterThanOrEqualTo('workorder.workorder_date_scheduled', $start);
        }
        
        if ($end) {
            $select->where->lessThanOrEqualTo('workorder.workorder_date_close', $end);
        }
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new ResultSet();
            
            $resultSet->initialize($result);
            
            $resultSet->buffer();
            
            $row = $resultSet->current();
            
            return $row->workorder_labor_total;
        }
        
        return 0;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderTime\Mapper\TimeMapperInterface::getEmployeeTime()
     */
    public function getEmployeeTime($employeeId, $start = null, $end = null)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_time');
        
        $select->where(array(
            'workorder_time.employee_id = ?' => $employeeId
        ));
        
        if ($start) {
            $select->where->greaterThanOrEqualTo('workorder_time.workorder_time_in', $start);
        }
        
        if ($end) {
            $select->where->lessThanOrEqualTo('workorder_time.workorder_time_out', $end);
        }
        
        // join workorder
        $select->join('workorder', 'workorder_time.workorder_id = workorder.workorder_id', array(
            'client_id'
        ), 'inner');
        
        // join client
        $select->join('client', 'workorder.client_id = client.client_id', array(
            'client_name'
        ), 'inner');
        
        $select->order('workorder_time.workorder_time_in');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderTime\Mapper\TimeMapperInterface::getEmployeeTotalTime()
     */
    public function getEmployeeTotalTime($employeeId, $start = null, $end = null)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_time');
        
        $select->columns(array(
            'time_total' => new \Zend\Db\Sql\Expression('SUM(workorder_time_total)')
        ));
        
        $select->where(array(
            'workorder_time.employee_id = ?' => $employeeId
        ));
        
        if ($start) {
            $select->where->greaterThanOrEqualTo('workorder_time.workorder_time_in', $start);
        }
        
        if ($end) {
            $select->where->lessThanOrEqualTo('workorder_time.workorder_time_out', $end);
        }
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new ResultSet();
            
            $resultSet->initialize($result);
            
            $resultSet->buffer();
            
            $row = $resultSet->current();
            
            return $row->time_total;
        }
        
        return 0;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderTime\Mapper\TimeMapperInterface::getTotalsForMonth()
     */
    public function getTotalsForMonth($start, $end)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_time');
        
        $select->columns(array(
            'workorder_labor_total' => new \Zend\Db\Sql\Expression('SUM(labor_total)'),
            'workorder_time_in',
            'day' => new \Zend\Db\Sql\Expression("Day(FROM_UNIXTIME('workorder_time_in'))"),
        ));
        
        $select->group(new \Zend\Db\Sql\Expression("Day( FROM_UNIXTIME( `workorder_time_in` ) )"));
        
        // join workorder
        $select->join('workorder', 'workorder_time.workorder_id = workorder.workorder_id', array(
        ), 'inner');
        

        if ($start) {
           $select->where->greaterThanOrEqualTo('workorder.workorder_date_scheduled', $start);
        }
        
        if ($end) {
           $select->where->lessThanOrEqualTo('workorder.workorder_date_close', $end);
        }
        
        //echo $sql->getSqlstringForSqlObject($select); die ;
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new ResultSet();
            
            $resultSet->initialize($result);
            
            $resultSet->buffer();

            
            return $resultSet;
        }
        
        return 0;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderTime\Mapper\TimeMapperInterface::getTotalsForYear()
     */
    public function getTotalsForYear($start, $end, $clientId = null)
    {
        $sql = new Sql($this->readAdapter);
    
        $select = $sql->select('workorder_time');
    
        $select->columns(array(
            'workorder_labor_total' => new \Zend\Db\Sql\Expression('SUM(labor_total)'),
            'workorder_time_in',
            'day' => new \Zend\Db\Sql\Expression("Month(FROM_UNIXTIME('workorder_time_in'))"),
        ));
    
        $select->group(new \Zend\Db\Sql\Expression("Month( FROM_UNIXTIME( `workorder_time_in` ) )"));
    
        // join workorder
        $select->join('workorder', 'workorder_time.workorder_id = workorder.workorder_id', array(
        ), 'inner');
    
        
    
        if ($start) {
            $select->where->greaterThanOrEqualTo('workorder.workorder_date_scheduled', $start);
        }
    
        if ($end) {
            $select->where->lessThanOrEqualTo('workorder.workorder_date_close', $end);
        }
        
        if($clientId) {
            $select->where(array('workorder.client_id = ?' => $clientId));
        }
    
        //echo $sql->getSqlstringForSqlObject($select); die ;
    
        $stmt = $sql->prepareStatementForSqlObject($select);
    
        $result = $stmt->execute();
    
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
    
            $resultSet = new ResultSet();
    
            $resultSet->initialize($result);
    
            $resultSet->buffer();
    
    
            return $resultSet;
        }
    
        return 0;
    }
}