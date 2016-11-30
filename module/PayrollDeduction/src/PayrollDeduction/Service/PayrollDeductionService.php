<?php
namespace PayrollDeduction\Service;

use PayrollDeduction\Entity\PayrollDeductionEntity;
use PayrollDeduction\Mapper\MysqlMapperInterface;

class PayrollDeductionService implements PayrollDeductionServiceInterface
{

    /**
     * 
     * @var MysqlMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param MysqlMapperInterface $mapper
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \PayrollDeduction\Service\PayrollDeductionServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PayrollDeduction\Service\PayrollDeductionServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PayrollDeduction\Service\PayrollDeductionServiceInterface::getPayrollDeductions()
     */
    public function getPayrollDeductions($payrollId)
    {
        return $this->mapper->getPayrollDeductions($payrollId);    
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \PayrollDeduction\Service\PayrollDeductionServiceInterface::save()
     */
    public function save(PayrollDeductionEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \PayrollDeduction\Service\PayrollDeductionServiceInterface::delete()
     */
    public function delete(PayrollDeductionEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

