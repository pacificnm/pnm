<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Employee\Hydrator\EmployeeHydrator;
use Employee\Entity\EmployeeEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class EmployeeCreateForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     * @return \Employee\Form\EmployeeForm
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
        
        // employeePhone
        $this->add(array(
            'name' => 'employeePhone',
            'type' => 'Text',
            'options' => array(
                'label' => 'Phone:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeePhone'
            )
        ));
        
        // employeePhoneMobile
        $this->add(array(
            'name' => 'employeePhoneMobile',
            'type' => 'Text',
            'options' => array(
                'label' => 'Mobile:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeePhoneMobile'
            )
        ));
        
        // employeeStreet
        $this->add(array(
            'name' => 'employeeStreet',
            'type' => 'Text',
            'options' => array(
                'label' => 'Street:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeStreet'
            )
        ));
        
        // employeeStreetCont
        $this->add(array(
            'name' => 'employeeStreetCont',
            'type' => 'Text',
            'options' => array(
                'label' => 'Street Cont:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeStreetCont'
            )
        ));
        
        // employeeCity
        $this->add(array(
            'name' => 'employeeCity',
            'type' => 'Text',
            'options' => array(
                'label' => 'City:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeCity'
            )
        ));
        
        // employeeState
        $this->add(array(
            'name' => 'employeeState',
            'type' => 'Text',
            'options' => array(
                'label' => 'State:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeState'
            )
        ));
        
        // employeePostal
        $this->add(array(
            'name' => 'employeePostal',
            'type' => 'Text',
            'options' => array(
                'label' => 'Postal:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeePostal'
            )
        ));
        
        
        // employeeIm
        $this->add(array(
            'name' => 'employeeIm',
            'type' => 'Text',
            'options' => array(
                'label' => 'Instant Messenger:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeIm'
            )
        ));
        
        // employeeImage
        $this->add(array(
            'name' => 'employeeImage',
            'type' => 'File',
            'options' => array(
                'label' => 'Image:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeImage'
            )
        ));
        
        // employeeStatus
        $this->add(array(
            'type' => 'Select',
            'name' => 'employeeStatus',
            'options' => array(
                'label' => 'Status:',
                'value_options' => array(
                    'Active' => 'Active',
                    'Closed' => 'Closed',
                    'Deleted' => 'Deleted'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeStatus'
            )
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
            
            // employeeIm
            'employeeIm' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                )
            ),
            
            // employeeImage
            'employeeImage' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                )
            ),
            
            // employeeStatus
            'employeeStatus' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Employee Status is required and cannot be empty."
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
            )
        );
    }
}