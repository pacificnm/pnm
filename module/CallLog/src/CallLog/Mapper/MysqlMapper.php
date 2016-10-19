<?php
namespace CallLog\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use CallLog\Entity\LogEntity;
use Zend\Db\Sql\Expression;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param LogEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, LogEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLog\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('call_log');
        
        $this->filter($filter)
            ->joinAuth()
            ->joinClient()
            ->joinEmployee();
        
        return $this->getPaginator();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \CallLog\Mapper\MysqlMapperInterface::getEmployeeCallLogs()
     */
    public function getEmployeeCallLogs($employeeId)
    {
        $this->select = $this->readSql->select('call_log');
        
        $this->select->where(array(
            'call_log.employee_id = ?' => $employeeId
        ));
        
        $this->select->where(array(
            'call_log.call_log_read = ?' => 0
        ));
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \CallLog\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('call_log');
        
        $this->select->where(array(
            'call_log.call_log_id = ?' => $id
        ));
        
        // joins
        $this->joinAuth()
            ->joinClient()
            ->joinEmployee();
        
        return $this->getRow();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \CallLog\Mapper\MysqlMapperInterface::save()
     */
    public function save(LogEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
         
        // if we have id then its an update
        if ($entity->getCallLogId()) {
            $this->update = new Update('call_log');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'call_log.call_log_id = ?' => $entity->getCallLogId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('call_log');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setCallLogId($id);

           
        }
        
        return $this->get($entity->getCallLogId());
    }

    /**
     * 
     * {@inheritDoc}
     * @see \CallLog\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(LogEntity $entity)
    {
        $this->delete = new Delete('call_log');
        
        $this->delete->where(array(
            'call_log.call_log_id = ?' => $entity->getCallLogId()
        ));
        
        return $this->deleteRow();
    }

    /**
     * 
     * @param array $filter
     * @return \CallLog\Mapper\MysqlMapper
     */
    protected function filter(array $filter)
    {
        if(array_key_exists('clientId', $filter)) {
            $this->select->where(array('call_log.client_id = ?' => $filter['clientId']));
        }
        
        return $this;
    }

    /**
     *
     * @return \CallLog\Mapper\MysqlMapper
     */
    protected function joinEmployee()
    {
        // join employee
        $this->select->join('employee', 'call_log.employee_id = employee.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_phone',
            'employee_phone_mobile',
            'employee_image',
            'employee_status'
        ), 'left');
        
        return $this;
    }

    /**
     *
     * @return \CallLog\Mapper\MysqlMapper
     */
    protected function joinClient()
    {
        $this->select->join('client', 'client.client_id = call_log.client_id', array(
            'client_name',
            'client_status',
            'client_created'
        ), 'left');
        
        // join phone number
        $expresion = new Expression("client.client_id = phone.client_id AND phone.phone_type = 'Primary'");
        
        $this->select->join('phone', $expresion, array(
            'phone_type',
            'phone_num'
        ), 'left');
        
        // join address
        
        return $this;
    }

    /**
     *
     * @return \CallLog\Mapper\MysqlMapper
     */
    protected function joinAuth()
    {
        $this->select->join('auth', 'call_log.call_log_created_by = auth.auth_id', array(
            'auth_id',
            'auth_role',
            'auth_email',
            'auth_name',
            'auth_type'
        ), 'left');
        
        return $this;
    }
}