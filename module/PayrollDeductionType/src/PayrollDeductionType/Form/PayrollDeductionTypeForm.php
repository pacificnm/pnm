<?php
namespace PayrollDeductionType\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use PayrollDeductionType\Hydrator\PayrollDeductionTypeHydrator;
use PayrollDeductionType\Entity\PayrollDeductionTypeEntity;

class PayrollDeductionTypeForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     */
    public function __construct($name = 'payroll-deduction-type-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new PayrollDeductionTypeHydrator(false));
        
        $this->setObject(new PayrollDeductionTypeEntity());
        
        // payrollDeductionTypeId
        $this->add(array(
            'name' => 'payrollDeductionTypeId',
            'type' => 'hidden'
        ));
        
        // payrollDeductionTypeName
        $this->add(array(
            'name' => 'payrollDeductionTypeName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollDeductionTypeName'
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
     *
     * {@inheritDoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // payrollDeductionTypeId
            
            // payrollDeductionTypeName
            'payrollDeductionTypeName' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Deduction Type Name is required and cannot be empty."
                            )
                        )
                    )
                )
            )
        );
    }
}