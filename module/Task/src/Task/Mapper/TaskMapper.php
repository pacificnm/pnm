<?php
namespace Task\Mapper;

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
use Task\Entity\TaskEntity;

class TaskMapper implements TaskMapperInterface
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
     * @var TaskEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param TaskEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, TaskEntity $prototype)
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
     * @see \Task\Mapper\TaskMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('task');
        
        // client id
        if (array_key_exists('clientId', $filter) && ! empty($filter['clientId'])) {
            $select->where(array(
                'task.client_Id = ?' => $filter['clientId']
            ));
        }
        
        // employeeId
        if (array_key_exists('employeeId', $filter) && ! empty($filter['employeeId'])) {
            $select->where(array(
                'task.employee_id = ?' => $filter['employeeId']
            ));
        }
        
        // task status
        if (array_key_exists('taskStatus', $filter) && ! empty($filter['taskStatus'])) {
            $select->where(array(
                'task.task_status = ?' => $filter['taskStatus']
            ));
        }
        
        // join priority
        $select->join('task_priority', 'task_priority.task_priority_id = task.task_priority_id', array(
            'task_priority_value'
        ), 'inner');
        
        // join employee
        $select->join('employee', 'task.employee_id = employee.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_im',
            'employee_image',
            'employee_status'
        ), 'left');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Task\Mapper\TaskMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('task');
        
        $select->where(array(
            'task.task_id = ?' => $id
        ));
        
        // join priority
        $select->join('task_priority', 'task_priority.task_priority_id = task.task_priority_id', array(
            'task_priority_value'
        ), 'inner');
        
        // join employee
        $select->join('employee', 'task.employee_id = employee.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_im',
            'employee_image',
            'employee_status'
        ), 'left');
        

        
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
     * @see \Task\Mapper\TaskMapperInterface::getEmployeeReminders()
     */
    public function getEmployeeReminders($employeeId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('task');
        
        $select->where(array(
            'task.employee_id = ?' => $employeeId
        ));
        
        $select->where(array(
            'task.task_status = ?' => 'Active'
        ));
        
        // join priority
        $select->join('task_priority', 'task_priority.task_priority_id = task.task_priority_id', array(
            'task_priority_value'
        ), 'inner');
        
        
        $select->join('client', 'client.client_id = task.client_id', array(
            'client_name'
        ), 'inner');
        
        $select->where(array('task.task_date_reminder_active = ?' => 1));
        
        $select->where->lessThanOrEqualTo('task_date_reminder', time());
        
        // echo $sql->getSqlstringForSqlObject($select); die ;
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
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
     * @see \Task\Mapper\TaskMapperInterface::save()
     */
    public function save(TaskEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getTaskId()) {
            
            // ID present, it's an Update
            $action = new Update('task');
            
            $action->set($postData);
            
            $action->where(array(
                'task.task_id = ?' => $entity->getTaskId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('task');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setTaskId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Task\Mapper\TaskMapperInterface::delete()
     */
    public function delete(TaskEntity $entity)
    {
        $action = new Delete('task');
        
        $action->where(array(
            'task.task_id = ?' => $entity->getTaskId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}