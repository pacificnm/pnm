<?php
namespace Workorder\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class CompleteForm extends Form implements InputFilterProviderInterface
{
    function __construct($name = 'workrder-complete-form', $options = array())
    {
        parent::__construct($name, $options);
        
        // workorderDateClose
        $this->add(array(
            'name' => 'workorderDateClose',
            'type' => 'Text',
            'options' => array(
                'label' => 'Completed:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderDateClose'
            )
        ));
        
        // createInvoice
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'createInvoice',
            'options' => array(
                'label' => 'Create Invoice',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'id' => 'createInvoice'
            )
        ));
        
        // button
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
        
        return $this;
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