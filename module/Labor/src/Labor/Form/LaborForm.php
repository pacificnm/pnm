<?php
namespace Labor\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Labor\Hydrator\LaborHydrator;
use Labor\Entity\LaborEntity;

class LaborForm extends Form implements InputFilterProviderInterface
{

    function __construct($name = 'labor-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new LaborHydrator(false));
        
        $this->setObject(new LaborEntity());
        
        // laborId
        $this->add(array(
            'name' => 'laborId',
            'type' => 'hidden'
        ));
        
        // laborName
        $this->add(array(
            'name' => 'laborName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'laborName'
            )
        ));
        
        // laborAmount
        $this->add(array(
            'name' => 'laborAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Amount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'laborAmount'
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
            // laborId
            'laborId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Labor Rate Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // laborName
            'laborName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Labor Rate Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // laborAmount
            'laborAmount' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Labor Rate Amount is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => '\Zend\I18n\Validator\IsFloat',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\IsFloat::INVALID => "The Labor Rate Amount is not valid.",
                                \Zend\I18n\Validator\IsFloat::NOT_FLOAT => "The Labor Rate Amount is not valid."
                            )
                        )
                    )
                )
            ),
            
        );
    }
}