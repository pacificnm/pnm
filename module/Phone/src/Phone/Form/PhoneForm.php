<?php
namespace Phone\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Phone\Hydrator\PhoneHydrator;
use Phone\Entity\PhoneEntity;

class PhoneForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @param string $name
     * @param array $options
     * @return \Phone\Form\PhoneForm
     */
    function __construct($name = 'phone-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new PhoneHydrator(false));
        
        $this->setObject(new PhoneEntity());
        
        // phoneId
        $this->add(array(
            'name' => 'phoneId',
            'type' => 'hidden'
        ));
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden'
        ));
        
        // locationId
        $this->add(array(
            'name' => 'locationId',
            'type' => 'hidden'
        ));
        
        // phoneType
        $this->add(array(
            'type' => 'Select',
            'name' => 'phoneType',
            'options' => array(
                'label' => 'Type:',
                'value_options' => array(
                    'Primary' => 'Primary',
                    'Fax' => 'Fax'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'phoneType'
            )
        ));
        
        // phoneNum
        $this->add(array(
            'name' => 'phoneNum',
            'type' => 'Text',
            'options' => array(
                'label' => 'Phone Number:'
            ),
            'attributes' => array(
                'class' => 'form-control phone',
                'id' => 'phoneNum',
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
            // phoneId
            'phoneId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Phone Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // clientId
            'clientId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Client Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // locationId
            'locationId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Location Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // phoneType
            'phoneType' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Phone Type is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // phoneNum
            'phoneNum' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Phone Number is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
        
    }

}
