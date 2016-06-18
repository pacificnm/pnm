<?php
namespace HostAttribute\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use HostAttribute\Hydrator\AttributeHydrator;
use HostAttribute\Entity\AttributeEntity;

class AttributeForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @param string $name
     * @param array $options
     */
    function __construct($name = 'host-attribute-form', $options = array())
    {
        parent::__construct($name, $options);
    
        $this->setHydrator(new AttributeHydrator(false));
    
        $this->setObject(new AttributeEntity());
    
        // hostAttributeId
        $this->add(array(
            'name' => 'hostAttributeId',
            'type' => 'hidden'
        ));
        
        // hostAttributeName
        $this->add(array(
            'name' => 'hostAttributeName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'hostAttributeName'
            )
        ));
        
        // hostAttributeType
        $this->add(array(
            'name' => 'hostAttributeType',
            'type' => 'Select',
            'options' => array(
                'label' => 'Type:',
                'value_options' => array(
                    'select' => 'select',
                    'text' => 'text',
                    'long text' => 'long tex',
                    'boolen' => 'boolen',
                    'password' => 'password'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'hostAttributeType'
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
            // hostAttributeId
            'hostAttributeId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Host Attribute Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // hostAttributeName
            'hostAttributeName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Host Attribute Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // hostAttributeType
            'hostAttributeType' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Host Attribute Type is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
        
    }

}
