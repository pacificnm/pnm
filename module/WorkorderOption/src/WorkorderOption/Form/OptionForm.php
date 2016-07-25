<?php
namespace WorkorderOption\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use WorkorderOption\Hydrator\OptionHydrator;
use WorkorderOption\Entity\OptionEntity;

class OptionForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @param string $name
     * @param array $options
     * @return \WorkorderOption\Form\OptionForm
     */
    function __construct($name = 'workrder-option-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new OptionHydrator(false));
        
        $this->setObject(new OptionEntity());
        
        $this->setAttribute('method', 'POST');
        
        // workorderOptionId
        $this->add(array(
            'name' => 'workorderOptionId',
            'type' => 'hidden'
        ));
        
        // workorderOptionDisclaimer
        $this->add(array(
            'name' => 'workorderOptionDisclaimer',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Disclaimer:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderOptionDisclaimer',
                'required' => true
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
        return array(
            // workorderOptionId
            'workorderOptionId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Option Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderOptionDisclaimer
            'workorderOptionDisclaimer' => array(
                'required' => true,
                'filters' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Option Disclaimer is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
        
    }

}

