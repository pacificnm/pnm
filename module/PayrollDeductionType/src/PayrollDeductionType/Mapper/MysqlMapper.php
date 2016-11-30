<?php
namespace PayrollDeductionType\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use PayrollDeductionType\Entity\PayrollDeductionTypeEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param PayrollDeductionTypeEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, PayrollDeductionTypeEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PayrollDeductionType\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('payroll_deduction_type');
        
        $this->filter($filter);
        
        $this->select->order('payroll_deduction_type_name');
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PayrollDeductionType\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('payroll_deduction_type');
        
        $this->select->where(array(
            'payroll_deduction_type.payroll_deduction_type_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PayrollDeductionType\Mapper\MysqlMapperInterface::save()
     */
    public function save(PayrollDeductionTypeEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getPayrollDeductionTypeId()) {
            $this->update = new Update('payroll_deduction_type');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'payroll_deduction_type.payroll_deduction_type_id = ?' => $entity->getPayrollDeductionTypeId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('payroll_deduction_type');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setPayrollDeductionTypeId($id);
        }
        
        return $this->get($entity->getPayrollDeductionTypeId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PayrollDeductionType\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(PayrollDeductionTypeEntity $entity)
    {
        $this->delete = new Delete('payroll_deduction_type');
        
        $this->delete->where(array(
            'payroll_deduction_type.payroll_deduction_type_id = ?' => $entity->getPayrollDeductionTypeId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \PayrollDeductionType\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }
}