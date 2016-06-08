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