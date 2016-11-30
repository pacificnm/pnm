<?php
namespace Payroll\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use Payroll\Entity\PayrollEntity;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param PayrollEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, PayrollEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('payroll');
        
        $this->filter($filter);
        
        $this->joinEmployee();
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('payroll');
        
        $this->select->where(array(
            'payroll.payroll_id = ?' => $id
        ));
        
        $this->joinEmployee();
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Mapper\MysqlMapperInterface::getYtdFederalIncomeTax()
     */
    public function getYtdFederalIncomeTax($employeeId, $year)
    {
        $this->select = $this->readSql->select('payroll');
        
        $this->select->columns(array(
            'payroll_ytd_tax_federal_income' => new \Zend\Db\Sql\Expression('sum(payroll_tax_federal_income)')
        ));
        
        $this->select->where(array(
            'payroll.employee_id = ?' => $employeeId
        ));
        
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
        
            $resultSet = new ResultSet();
        
            $resultSet->initialize($result);
        
            $row = $resultSet->current();
        
            return $row['payroll_ytd_tax_federal_income'];
        }
        
        return 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Mapper\MysqlMapperInterface::getYtdSocialSecurityTax()
     */
    public function getYtdSocialSecurityTax($employeeId, $year)
    {
        $this->select = $this->readSql->select('payroll'); 
        
        $this->select->columns(array(
            'payroll_ytd_tax_social_security' => new \Zend\Db\Sql\Expression('sum(payroll_tax_social_security)')
        ));
        
        $this->select->where(array(
            'payroll.employee_id = ?' => $employeeId
        ));
        
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
        
            $resultSet = new ResultSet();
        
            $resultSet->initialize($result);
        
            $row = $resultSet->current();
        
            return $row['payroll_ytd_tax_social_security'];
        }
        
        return 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Mapper\MysqlMapperInterface::getYtdMedicareTax()
     */
    public function getYtdMedicareTax($employeeId, $year)
    {
        $this->select = $this->readSql->select('payroll');
        
        $this->select->columns(array(
            'payroll_ytd_tax_medicare' => new \Zend\Db\Sql\Expression('sum(payroll_tax_medicare)')
        ));
        
        $this->select->where(array(
            'payroll.employee_id = ?' => $employeeId
        ));
        
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
        
            $resultSet = new ResultSet();
        
            $resultSet->initialize($result);
        
            $row = $resultSet->current();
        
            return $row['payroll_ytd_tax_medicare'];
        }
        
        return 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Mapper\MysqlMapperInterface::getYtdStateTax()
     */
    public function getYtdStateTax($employeeId, $year)
    {
        $this->select = $this->readSql->select('payroll');
        
        $this->select->columns(array(
            'payroll_ytd_tax_state' => new \Zend\Db\Sql\Expression('sum(payroll_tax_state)')
        ));
        
        $this->select->where(array(
            'payroll.employee_id = ?' => $employeeId
        ));
        
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
        
            $resultSet = new ResultSet();
        
            $resultSet->initialize($result);
        
            $row = $resultSet->current();
        
            return $row['payroll_ytd_tax_state'];
        }
        
        return 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Mapper\MysqlMapperInterface::getYtdGross()
     */
    public function getYtdGross($employeeId, $year)
    {
        $this->select = $this->readSql->select('payroll');
        
        $this->select->columns(array(
            'payroll_ytd_wages_gross' => new \Zend\Db\Sql\Expression('sum(payroll_wages_gross)')
        ));
        
        $this->select->where(array(
            'payroll.employee_id = ?' => $employeeId
        ));
        
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
        
            $resultSet = new ResultSet();
        
            $resultSet->initialize($result);
        
            $row = $resultSet->current();
        
            return $row['payroll_ytd_wages_gross'];
        }
        
        return 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Mapper\MysqlMapperInterface::getYtdNet()
     */
    public function getYtdNet($employeeId, $year)
    {
        $this->select = $this->readSql->select('payroll');
        
        $this->select->columns(array(
            'payroll_ytd_wages_net' => new \Zend\Db\Sql\Expression('sum(payroll_wages_net)')
        ));
        
        $this->select->where(array(
            'payroll.employee_id = ?' => $employeeId
        ));
        
        $stmt = $this->readSql->prepareStatementForSqlObject($this->select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
        
            $resultSet = new ResultSet();
        
            $resultSet->initialize($result);
        
            $row = $resultSet->current();
        
            return $row['payroll_ytd_wages_net'];
        }
        
        return 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Mapper\MysqlMapperInterface::save()
     */
    public function save(PayrollEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getPayrollId()) {
            $this->update = new Update('payroll');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'payroll.payroll_id = ?' => $entity->getPayrollId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('payroll');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setPayrollId($id);
        }
        
        return $this->get($entity->getPayrollId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Payroll\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(PayrollEntity $entity)
    {
        $this->delete = new Delete('payroll');
        
        $this->delete->where(array(
            'payroll.payroll_id = ?' => $entity->getPayrollId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param unknown $filter            
     * @return \Payroll\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        // employeeID
        if (array_key_exists('employeeId', $filter['employeeId'])) {
            $this->select->where(array(
                'payroll.employee_id = ?' => $filter['employeeId']
            ));
        }
        
        return $this;
    }

    /**
     *
     * @return \Payroll\Mapper\MysqlMapper
     */
    protected function joinEmployee()
    {
        $this->select->join('employee', 'employee.employee_id = payroll.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_phone',
            'employee_street',
            'employee_street_cont',
            'employee_city',
            'employee_state',
            'employee_postal',
            'employee_ssn',
            'employee_marital_status',
            'employee_wage',
            'employee_tax_allowance',
            'employee_status'
        ), 'inner');
        return $this;
    }
}
