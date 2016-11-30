<?php
namespace PayrollDeduction\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use PayrollDeduction\Entity\PayrollDeductionEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param PayrollDeductionEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, PayrollDeductionEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \PayrollDeduction\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('payroll_deduction');
        
        $this->filter($filter);
        
        $this->joinDeductionType();
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \PayrollDeduction\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('payroll_deduction');
        
        $this->joinDeductionType();
        
        $this->select->where(array(
            'payroll_deduction.payroll_deduction_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PayrollDeduction\Mapper\MysqlMapperInterface::getPayrollDeductions()
     */
    public function getPayrollDeductions($payrollId)
    {
        $this->select = $this->readSql->select('payroll_deduction');
        
        $this->joinDeductionType()->joinYearToDate();
                
        $this->select->where(array(
            'payroll_deduction.payroll_id = ?' => $payrollId
        ));
        
        return $this->getRows();
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \PayrollDeduction\Mapper\MysqlMapperInterface::save()
     */
    public function save(PayrollDeductionEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getPayrollDeductionId()) {
            $this->update = new Update('payroll_deduction');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'payroll_deduction.payroll_deduction_id = ?' => $entity->getPayrollDeductionId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('payroll_deduction');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setPayrollDeductionId($id);
        }
        
        return $this->get($entity->getPayrollDeductionId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \PayrollDeduction\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(PayrollDeductionEntity $entity)
    {
        $this->delete = new Delete('payroll_deduction');
        
        $this->delete->where(array(
            'payroll_deduction.payroll_deduction_id = ?' => $entity->getPayrollDeductionId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \PayrollDeduction\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }

    /**
     *
     * @return \PayrollDeduction\Mapper\MysqlMapper
     */
    protected function joinDeductionType()
    {
        $this->select->join('payroll_deduction_type', 'payroll_deduction.payroll_deduction_type_id = payroll_deduction_type.payroll_deduction_type_id', array(
            'payroll_deduction_type_name'
        ), 'inner');
        return $this;
    }
    
    protected function joinYearToDate()
    {
        $this->select->join(array('payroll_deduction_sum' => 'payroll_deduction'), 'payroll_deduction.payroll_deduction_type_id = payroll_deduction_sum.payroll_deduction_type_id', 
                array('payroll_deduction_ytd' => new \Zend\Db\Sql\Expression('sum(payroll_deduction_sum.payroll_deduction_amount)')), 'left');
        
        return $this;
    }
}

