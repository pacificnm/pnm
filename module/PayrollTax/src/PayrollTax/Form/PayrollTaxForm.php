<?php
namespace PayrollTax\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use PayrollTax\Hydrator\PayrollTaxHydrator;
use PayrollTax\Entity\PayrollTaxEntity;


class PayrollTaxForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @param string $name
     * @param array $options
     */
    public function __construct($name = 'payroll-tax-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new PayrollTaxHydrator(false));
        
        $this->setObject(new PayrollTaxEntity());
        
        // payrollTaxId
        $this->add(array(
            'name' => 'payrollTaxId',
            'type' => 'hidden'
        ));
        
        // payrollTaxFederal
        $this->add(array(
            'name' => 'payrollTaxFederal',
            'type' => 'Text',
            'options' => array(
                'label' => 'Federal Tax:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollTaxFederal'
            )
        ));
        
        // payrollTaxSocialSecurity
        $this->add(array(
            'name' => 'payrollTaxSocialSecurity',
            'type' => 'Text',
            'options' => array(
                'label' => 'Social Security Tax:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollTaxSocialSecurity'
            )
        ));
        
        // payrollTaxMedicare
        $this->add(array(
            'name' => 'payrollTaxMedicare',
            'type' => 'Text',
            'options' => array(
                'label' => 'Medicare Tax:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollTaxMedicare'
            )
        ));
        
        // payrollTaxState
        $this->add(array(
            'name' => 'payrollTaxState',
            'type' => 'Text',
            'options' => array(
                'label' => 'State Tax:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollTaxState'
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

}

