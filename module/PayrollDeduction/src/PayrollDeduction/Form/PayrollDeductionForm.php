<?php
namespace PayrollDeduction\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface;
use PayrollDeduction\Hydrator\PayrollDeductionHydrator;
use PayrollDeduction\Entity\PayrollDeductionEntity;

class PayrollDeductionForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @var PayrollDeductionTypeServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @param PayrollDeductionTypeServiceInterface $service
     * @param string $name
     * @param array $options
     */
    public function __construct(PayrollDeductionTypeServiceInterface $service, $name = 'payroll-form', $options = array())
    {
        parent::__construct($name, $options);
    
        $this->setHydrator(new PayrollDeductionHydrator(false));
    
        $this->setObject(new PayrollDeductionEntity());
        
        $this->service = $service;
        
        
        // payrollDeductionId
        $this->add(array(
            'name' => 'payrollDeductionId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'payrollDeductionId'
            )
        ));
        
        // payrollId
        $this->add(array(
            'name' => 'payrollId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'payrollId'
            )
        ));
        
        // payrollDeductionYear
        $this->add(array(
            'name' => 'payrollDeductionYear',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'payrollDeductionYear'
            )
        ));
        
        // payrollDeductionTypeId
        $this->add(array(
            'type' => 'Select',
            'name' => 'payrollDeductionTypeId',
            'options' => array(
                'label' => 'Deduction Type:',
                'value_options' => $this->getDeductionTypeOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollDeductionTypeId'
            )
        ));
        
        // payrollDeductionAmount
        $this->add(array(
            'name' => 'payrollDeductionAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Deduction Amount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollDeductionAmount'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array();
        
    }

    /**
     * 
     * @return \PayrollDeductionType\Entity\the[]
     */
    protected function getDeductionTypeOptions()
    {
        $options = array();
        
        $filter = array(
            'pagination' => 'off'
        );
        
        $entitys = $this->service->getAll($filter);
        
        foreach($entitys as $entity) {
            $options[$entity->getPayrollDeductionTypeId()] = $entity->getPayrollDeductionTypeName();
        }
        
        return $options;
    }
}

