<?php
namespace HostType\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use HostType\Hydrator\TypeHydrator;
use HostType\Entity\TypeEntity;

class TypeForm extends Form implements InputFilterProviderInterface
{

    /**
     * 
     * @param string $name
     * @param array $options
     * @return \HostType\Form\TypeForm
     */
    function __construct($name = 'host-type-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new TypeHydrator(false));
        
        $this->setObject(new TypeEntity());
        
        // hostTypeId
        $this->add(array(
            'name' => 'hostTypeId',
            'type' => 'hidden'
        ));
        
        // hostTypeName
        $this->add(array(
            'name' => 'hostTypeName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'hostTypeName'
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
     *
     * {@inheritDoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // hostTypeId
            'hostTypeId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Host Type Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // hostTypeName
            'hostTypeName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Host Type Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
    }
}
