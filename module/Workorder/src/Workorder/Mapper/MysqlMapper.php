<?php
namespace Workorder\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use Workorder\Entity\WorkorderEntity;
use Zend\Db\Sql\Expression;
use Zend\Db\Adapter\Driver\ResultInterface;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param WorkorderEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, WorkorderEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('workorder');
        
        $this->filter($filter);
        
        $this->joinClient()
            ->joinLocation()
            ->joinPhone()
            ->joinUser();
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('workorder');
        
        $this->select->where(array(
            'workorder.workorder_id = ?' => $id
        ));
        
        $this->joinClient()
            ->joinLocation()
            ->joinPhone()
            ->joinUser();
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::getClientTotalPart()
     */
    public function getClientTotalPart($clientId)
    {
        $this->select = $this->readSql->select('workorder');
        
        $this->select->columns(array(
            'workorder_part_total' => new \Zend\Db\Sql\Expression('SUM(workorder_parts)')
        ));
        
        $this->select->where(array(
            'client_id = ?' => $clientId
        ));
        
        $this->select->where(array(
            'workorder.workorder_status = ?' => 'Closed'
        ));
        
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
        
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
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::getByDateRange()
     */
    public function getByDateRange($start, $end, $status, $paginator = true)
    {
        $this->select = $this->readSql->select('workorder');
        
        // status
        $this->select->where(array(
            'workorder.workorder_status = ?' => $status
        ));
        
        if ($start) {
            $this->select->where->greaterThanOrEqualTo('workorder.workorder_date_scheduled', $start);
        }
        
        if ($end) {
            $this->select->where->lessThanOrEqualTo('workorder.workorder_date_close', $end);
        }
        
        $this->joinClient()
            ->joinLocation()
            ->joinPhone()
            ->joinUser();
        
        if($paginator == false) {
            return $this->getRows();
        }
            
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::getInvoiceWorkorders()
     */
    public function getInvoiceWorkorders($invoiceId)
    {
        $this->select = $this->readSql->select('workorder');
        
        $this->select->where(array(
            'workorder.invoice_id = ?' => $invoiceId
        ));
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::getClientUnInvoiced()
     */
    public function getClientUnInvoiced($clientId)
    {
        $this->select = $this->readSql->select('workorder');
        
        $this->select->where(array(
            'workorder.client_id = ?' => $clientId
        ));
        
        $this->select->where(array(
            'workorder.invoice_id = ?' => 0
        ));
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::getWorkorderSchedule()
     */
    public function getWorkorderSchedule(array $filter)
    {
        $this->select = $this->readSql->select('workorder');
        
        $this->filter($filter);
        
        $this->joinClient();
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::getClientTotalCount()
     */
    public function getClientTotalCount($clientId, $status)
    {
        $this->select = $this->readSql->select('workorder');
        
        $this->select->columns(array(
            'workorder_count' => new \Zend\Db\Sql\Expression('COUNT(*)')
        ));
        
        $this->select->where(array(
            'client_id = ?' => $clientId
        ));
        
        // status
        if (! empty($status)) {
            $this->select->where(array(
                'workorder.workorder_status = ?' => $status
            ));
        }
        
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
        
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
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::getClientTotalLabor()
     */
    public function getClientTotalLabor($clientId)
    {
        $this->select = $this->readSql->select('workorder');
        
        $this->select->columns(array(
            'workorder_labor_total' => new \Zend\Db\Sql\Expression('SUM(workorder_labor)')
        ));
        
        $this->select->where(array(
            'client_id = ?' => $clientId
        ));
        
        $this->select->where(array(
            'workorder.workorder_status = ?' => 'Closed'
        ));
        
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
        
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
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::save()
     */
    public function save(WorkorderEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getWorkorderId()) {
            $this->update = new Update('workorder');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'workorder.workorder_id = ?' => $entity->getWorkorderId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('workorder');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setWorkorderId($id);
        }
        
        return $this->get($entity->getWorkorderId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Workorder\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(WorkorderEntity $entity)
    {
        $this->delete = new Delete('workorder');
        
        $this->delete->where(array(
            'workorder.workorder_id = ?' => $entity->getWorkorderId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \Workorder\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        // client id
        if (array_key_exists('clientId', $filter) && ! empty($filter['clientId'])) {
            $this->select->where(array(
                'workorder.client_Id = ?' => $filter['clientId']
            ));
        }
        
        // workorder status
        if (array_key_exists('workorderStatus', $filter) && ! empty($filter['workorderStatus'])) {
            $this->select->where(array(
                'workorder.workorder_status = ?' => $filter['workorderStatus']
            ));
        }
        
        // keyword
        if (array_key_exists('keyword', $filter) && ! empty($filter['keyword'])) {
            if (is_numeric($filter['keyword'])) {
                $this->select->where(array(
                    'workorder.workorder_id = ?' => $filter['keyword']
                ));
            } else {
                $this->select->where->like('workorder.workorder_description', $filter['keyword'] . "%");
            }
        }
        
        // employee
        if (array_key_exists('employee', $filter) && ! empty($filter['employee'])) {
            $this->select->join('workorder_employee', 'workorder.workorder_id = workorder_employee.workorder_id', array(), 'inner');
            $this->select->where(array(
                'workorder_employee.employee_id = ?' => $filter['employee']
            ));
        }
        
        return $this;
    }

    /**
     *
     * @return \Workorder\Mapper\MysqlMapper
     */
    protected function joinLocation()
    {
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

    /**
     *
     * @return \Workorder\Mapper\MysqlMapper
     */
    protected function joinPhone()
    {
        $this->select->join('phone', 'location.location_id = phone.phone_id', array(
            'phone_type',
            'phone_num'
        ), 'left');
        
        return $this;
    }

    /**
     *
     * @return \Workorder\Mapper\MysqlMapper
     */
    protected function joinUser()
    {
        $expression = new Expression("location.location_id = user.location_id AND user.user_type = 'Primary' AND user.user_status = 'Active'");
        $this->select->join('user', $expression, array(
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
     * @return \Workorder\Mapper\MysqlMapper
     */
    protected function joinClient()
    {
        $this->select->join('client', 'workorder.client_id = client.client_id', array(
            'client_name',
            'client_status'
        ), 'inner');
        
        return $this;
    }
}

