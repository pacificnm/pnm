<?php
namespace WorkorderEmployee\Mapper;

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
use WorkorderEmployee\Entity\WorkorderEmployeeEntity;

class WorkorderEmployeeMapper implements WorkorderEmployeeMapperInterface
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
     * @var WorkorderEmployeeEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param WorkorderEmployeeEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, WorkorderEmployeeEntity $prototype)
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
     * @see \WorkorderEmployee\Mapper\WorkorderEmployeeMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_employee');
        
        $select->where(array(
            'workorder_employee.workorder_id = ?' => $filter['workorderId']
        ));
        
        // join employee
        $select->join('employee', 'workorder_employee.employee_id = employee.employee_id', array(
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
     * @see \WorkorderEmployee\Mapper\WorkorderEmployeeMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_employee');
        
        $select->where(array(
            'workorder_employee.workorder_employee_id = ?' => $id
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
     * @see \WorkorderEmployee\Mapper\WorkorderEmployeeMapperInterface::getEmployeeWorkorders()
     */
    public function getEmployeeWorkorders($employeeId, $status = 'Active')
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_employee');
        
        $select->where(array(
            'workorder_employee.employee_id = ?' => $employeeId
        ));
        
        $select->where(array(
            'workorder.workorder_status = ?' => $status
        ));
        
        // join workorder
        $select->join('workorder', 'workorder_employee_id = workorder.workorder_id', array(
            'client_id',
            'workorder_status',
            'workorder_description',
            'workorder_labor',
            'workorder_parts',
            'workorder_date_create',
            'workorder_date_scheduled',
            'workorder_date_end',
            'workorder_date_close'
        ), 'inner');
        
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
     * @see \WorkorderEmployee\Mapper\WorkorderEmployeeMapperInterface::save()
     */
    public function save(WorkorderEmployeeEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getWorkorderEmployeeId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder_employee');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder_employee.workorder_employee_id = ?' => $entity->getWorkorderEmployeeId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder_employee');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setWorkorderEmployeeId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderEmployee\Mapper\WorkorderEmployeeMapperInterface::delete()
     */
    public function delete(WorkorderEmployeeEntity $entity)
    {
        $action = new Delete('workorder_employee');
        
        $action->where(array(
            'workorder_employee.workorder_id = ?' => $entity->getWorkorderId()
        ));
        
        $action->where(array(
            'workorder_employee.employee_id = ?' => $entity->getEmployeeId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}