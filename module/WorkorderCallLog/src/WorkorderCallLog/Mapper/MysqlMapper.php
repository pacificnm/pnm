<?php
namespace WorkorderCallLog\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use WorkorderCallLog\Entity\WorkorderCallLogEntity;
use Zend\Db\Sql\Expression;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param WorkorderCallLogEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, WorkorderCallLogEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCallLog\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('workorder_call_log');
        
        $this->filter($filter)
            ->joinCallLog()
            ->joinEmployee();
        
        return $this->getPaginator();
    }

    /**
     *
     * @param number $callLogId            
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function getCallLogWorkorders($callLogId)
    {
        $this->select = $this->readSql->select('workorder_call_log');
        
        $this->select->where(array(
            'workorder_call_log.call_log_id = ?' => $callLogId
        ));
        
        $this->joinWorkorder()
            ->joinLocation()
            ->joinUser();
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCallLog\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('workorder_call_log');
        
        $this->select->where(array(
            'workorder_call_log.workorder_call_log_id = ?' => $id
        ));
        
        $this->joinCallLog()
            ->joinWorkorder();
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCallLog\Mapper\MysqlMapperInterface::save()
     */
    public function save(WorkorderCallLogEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getWorkorderCallLogId()) {
            $this->update = new Update('workorder_call_log');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'workorder_call_log.workorder_call_log = ?' => $entity->getWorkorderCallLogId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('workorder_call_log');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setWorkorderCallLogId($id);
        }
        
        return $this->get($entity->getWorkorderCallLogId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCallLog\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(WorkorderCallLogEntity $entity)
    {
        $this->delete = new Delete('workorder_call_log');
        
        $this->delete->where(array(
            'workorder_call_log.workorder_call_log_id = ?' => $entity->getWorkorderCallLogId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param unknown $filter            
     * @return \WorkorderCallLog\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        if ($this->debug) {
            \Zend\Debug\Debug::dump($filter);
        }
        
        if (array_key_exists('workorderId', $filter)) {
            $this->select->where(array(
                'workorder_call_log.workorder_id = ?' => $filter['workorderId']
            ));
        }
        
        return $this;
    }

    /**
     *
     * @return \WorkorderCallLog\Mapper\MysqlMapper
     */
    protected function joinCallLog()
    {
        $this->select->join('call_log', 'workorder_call_log.call_log_id = call_log.call_log_id', array(
            'client_id',
            'employee_id',
            'call_log_time',
            'call_log_detail',
            'call_log_require_call_back',
            'call_log_will_call_back',
            'call_log_voice_mail',
            'call_log_urgent',
            'call_log_read',
            'call_log_created_by'
        ), 'inner');
        
        return $this;
    }

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
     * @return \WorkorderCallLog\Mapper\MysqlMapper
     */
    protected function joinWorkorder()
    {
        $this->select->join('workorder', 'workorder_call_log.workorder_id = workorder.workorder_id', array(
            'client_id',
            'workorder_status',
            'workorder_title',
            'workorder_date_create',
            'workorder_date_scheduled',
            'workorder_date_end',
            'workorder_date_close'
        ), 'inner');
        
        return $this;
    }

    /**
     *
     * @return \WorkorderCallLog\Mapper\MysqlMapper
     */
    protected function joinUser()
    {
        // join primary user
        $exspresion = new Expression("location.location_id = user.location_id AND user.user_type = 'Primary' AND user.user_status = 'Active'");
        
        $this->select->join('user', $exspresion, array(
            'user_id',
            'user_status',
            'user_name_first',
            'user_name_last',
            'user_job_title',
            'user_email',
            'user_type'
        ), 'left');
        
        return $this;
    }

    /**
     *
     * @return \WorkorderCallLog\Mapper\MysqlMapper
     */
    protected function joinLocation()
    {
        // join location
        $this->select->join('location', 'workorder.location_id = location.location_id', array(
            'location_type',
            'location_street',
            'location_street_cont',
            'location_city',
            'location_state',
            'location_zip',
            'location_Status'
        ), 'left');
        
        return $this;
    }
}