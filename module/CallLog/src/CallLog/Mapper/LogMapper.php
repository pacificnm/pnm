<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace CallLog\Mapper;

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
use CallLog\Entity\LogEntity;

class LogMapper implements LogMapperInterface
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
     * @var LogEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param LogEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, LogEntity $prototype)
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
     * @see \CallLog\Mapper\LogMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('call_log');
        
        if (array_key_exists('clientId', $filter)) {
            $select->where(array(
                'call_log.client_id = ?' => $filter['clientId']
            ));
        }
        
        // join employee
        $select->join('employee', 'call_log.employee_id = employee.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_phone',
            'employee_phone_mobile',
            'employee_image',
            'employee_status'
        ), 'inner');
        
        // join auth
        $select->join('auth', 'call_log.call_log_created_by = auth.auth_id', array(
            'auth_id',
            'auth_role',
            'auth_email',
            'auth_name',
            'auth_type'
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
     * @see \CallLog\Mapper\LogMapperInterface::getEmployeeCallLogs()
     */
    public function getEmployeeCallLogs($employeeId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('call_log');
        
        $select->where(array(
            'call_log.employee_id = ?' => $employeeId
        ));
        
        $select->where(array(
            'call_log.call_log_read = ?' => 0
        ));
        
        // join employee
        $select->join('employee', 'call_log.employee_id = employee.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_phone',
            'employee_phone_mobile',
            'employee_image',
            'employee_status'
        ), 'inner');
        
        // join auth
        $select->join('auth', 'call_log.call_log_created_by = auth.auth_id', array(
            'auth_id',
            'auth_role',
            'auth_email',
            'auth_name',
            'auth_type'
        ), 'inner');
        
        // join client
        $select->join('client', 'call_log.client_id = client.client_id', array(
            'client_name'
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
     * @see \CallLog\Mapper\LogMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('call_log');
        
        $select->where(array(
            'call_log.call_log_id = ?' => $id
        ));
        
        // join employee
        $select->join('employee', 'call_log.employee_id = employee.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_phone',
            'employee_phone_mobile',
            'employee_image',
            'employee_status'
        ), 'inner');
        
        // join auth
        $select->join('auth', 'call_log.call_log_created_by = auth.auth_id', array(
            'auth_id',
            'auth_role',
            'auth_email',
            'auth_name',
            'auth_type'
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
     * @see \CallLog\Mapper\LogMapperInterface::save()
     */
    public function save(LogEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getCallLogId()) {
            
            // ID present, it's an Update
            $action = new Update('call_log');
            
            $action->set($postData);
            
            $action->where(array(
                'call_log.call_log_id = ?' => $entity->getCallLogId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('call_log');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setCallLogId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLog\Mapper\LogMapperInterface::delete()
     */
    public function delete(LogEntity $entity)
    {
        $action = new Delete('call_log');
        
        $action->where(array(
            'call_log.call_log_id = ?' => $entity->getCallLogId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}