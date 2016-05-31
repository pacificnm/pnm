<?php
namespace Password\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Password\Hydrator\PasswordHydrator;
use Password\Entity\PasswordEntity;

class PasswordForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @param string $name
     * @param array $options
     * @return \Password\Form\PasswordForm
     */
    function __construct($name = 'password-form', $options = array())
    {
        parent::__construct($name, $options);
    
        $this->setHydrator(new PasswordHydrator(false));
    
        $this->setObject(new PasswordEntity());
    
        // passwordId
        $this->add(array(
            'name' => 'passwordId',
            'type' => 'hidden'
        ));
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden'
        ));
        
        // passwordLocation
        $this->add(array(
            'name' => 'passwordLocation',
            'type' => 'Text',
            'options' => array(
                'label' => 'Location:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'passwordLocation'
            )
        ));
        
        // passwordTitle
        $this->add(array(
            'name' => 'passwordTitle',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'passwordTitle'
            )
        ));
        
        // passwordUsername
        $this->add(array(
            'name' => 'passwordUsername',
            'type' => 'Text',
            'options' => array(
                'label' => 'Username:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'passwordUsername'
            )
        ));
        
        // passwordPassword
        $this->add(array(
            'name' => 'passwordPassword',
            'type' => 'Text',
            'options' => array(
                'label' => 'Password:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'passwordPassword'
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
            // passwordId
            'passwordId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Password Id is required and cannot be empty."
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
            
            
            // passwordLocation
            'passwordLocation' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Location is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // passwordTitle
            'passwordTitle' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Title is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            
            // passwordUsername
            'passwordUsername' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Username is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // passwordPassword
            'passwordPassword' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Password is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
    }
}
