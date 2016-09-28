<?php
namespace PaymentOption\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use PaymentOption\Hydrator\OptionHydrator;
use PaymentOption\Entity\OptionEntity;

class OptionForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @param string $name
     * @param array $options
     * @return \PaymentOption\Form\OptionForm
     */
    public function __construct($name, $options)
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new OptionHydrator(false));
        
        $this->setObject(new OptionEntity());
        
        // paymentOptionId
        $this->add(array(
            'name' => 'paymentOptionId',
            'type' => 'hidden'
        ));
        
        // paymentOptionName
        $this->add(array(
            'name' => 'paymentOptionName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Payment Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'paymentOptionName'
            )
        ));
        
        // paymentOptionEnabled
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'paymentOptionEnabled',
            'options' => array(
                'label' => 'Enabled',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'id' => 'paymentOptionEnabled'
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
            // paymentOptionId
            'paymentOptionId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Payment Option Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            // paymentOptionName
            'paymentOptionName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Payment Option Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // paymentOptionEnabled
            
        );
        
    }

}
