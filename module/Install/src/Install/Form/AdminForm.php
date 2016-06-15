<?php
namespace Install\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Employee\Hydrator\EmployeeHydrator;
use Employee\Entity\EmployeeEntity;

class AdminForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     */
    function __construct($name = 'employee-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new EmployeeHydrator(false));
        
        $this->setObject(new EmployeeEntity());
        
        // employeeId
        $this->add(array(
            'name' => 'employeeId',
            'type' => 'hidden'
        ));
        
        // employeeName
        $this->add(array(
            'name' => 'employeeName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeName'
            )
        ));
        
        // employeeTitle
        $this->add(array(
            'name' => 'employeeTitle',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeTitle'
            )
        ));
        
        // employeeEmail
        $this->add(array(
            'name' => 'employeeEmail',
            'type' => 'Text',
            'options' => array(
                'label' => 'E-Mail:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeEmail'
            )
        ));
        
        // authPassword
        $this->add(array(
            'name' => 'authPassword',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authPassword',
                'placeholder' => 'Password'
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
            
            // employeeName
            'employeeName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Employee Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // employeeTitle
            'employeeTitle' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Employee Title is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // employeeEmail
            'employeeEmail' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Employee E-Mail is required and cannot be empty."
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
        );
    }
}
