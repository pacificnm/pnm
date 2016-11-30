<?php
namespace PayrollDeduction\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use PayrollDeduction\Entity\PayrollDeductionEntity;
use PayrollDeductionType\Entity\PayrollDeductionTypeEntity;

class PayrollDeductionHydrator extends ClassMethods
{

    /**
     *
     * @param string $underscoreSeparatedKeys            
     */
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::hydrate()
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof PayrollDeductionEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $payrollDeductionTypeEntity = parent::hydrate($data, new PayrollDeductionTypeEntity());
        
        $object->setPayrollDeductionTypeEntity($payrollDeductionTypeEntity);
        
        return $object;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::extract()
     */
    public function extract($object)
    {
        if (! $object instanceof PayrollDeductionEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['payroll_deduction_type_entity']);
        
        unset($data['payroll_deduction_ytd']);
        
        return $data;
    }
}

