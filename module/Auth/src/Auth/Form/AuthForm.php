<?php
namespace Auth\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Auth\Hydrator\AuthHydrator;
use Auth\Entity\AuthEntity;

class AuthForm extends Form implements InputFilterProviderInterface
{
    function __construct($name = 'auth-form', $options = array())
    {
        parent::__construct($name, $options);
    
        $this->setHydrator(new AuthHydrator(false));
    
        $this->setObject(new AuthEntity());
        
        // authId
        $this->add(array(
            'name' => 'authId',
            'type' => 'hidden'
        ));
        
        // authRole
        $this->add(array(
            'type' => 'Select',
            'name' => 'authRole',
            'options' => array(
                'label' => 'Role:',
                'value_options' => array(
                    'guest' => 'Guest',
                    'user' => 'User',
                    'employee' => 'Employee',
                    'accountant' => 'Accountant',
                    'administrator' => 'Administrator'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authRole'
            )
        ));
        
        // authEmail
        $this->add(array(
            'name' => 'authEmail',
            'type' => 'Text',
            'options' => array(
                'label' => 'E-Mail:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authEmail'
            )
        ));
        
        // authPassword
        $this->add(array(
            'name' => 'authPassword',
            'type' => 'hidden'
        ));
        
        // authName
        $this->add(array(
            'name' => 'authName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authName'
            )
        ));
        
        // authType
        $this->add(array(
            'type' => 'Select',
            'name' => 'authType',
            'options' => array(
                'label' => 'Type:',
                'value_options' => array(
                    'Employee' => 'Employee',
                    'User' => 'User'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authType'
            )
        ));
        
        // authLastLogin
        $this->add(array(
            'name' => 'authLastLogin',
            'type' => 'hidden'
        ));
        
        // authLastIp
        $this->add(array(
            'name' => 'authLastIp',
            'type' => 'hidden'
        ));
        
        // userId
        $this->add(array(
            'name' => 'userId',
            'type' => 'hidden'
        ));
        
        // employeeId
        $this->add(array(
            'name' => 'employeeId',
            'type' => 'hidden'
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
            // authId
            'authId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // authRole
            'authRole' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Role is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // authEmail
            'authEmail' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth E-Mail is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // authPassword
            'authPassword' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Password is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // authName
            'authName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // authType
            'authType' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Type is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // authLastLogin
            'authLastLogin' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Last Login is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // authLastIp
            'authLastIp' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
            ),
            
            // userId
            'userId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The User Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // employeeId
            'employeeId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Employee Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
        
    }

}