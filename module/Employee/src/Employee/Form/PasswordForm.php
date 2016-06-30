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
use Auth\Service\AuthServiceInterface;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class PasswordForm extends Form implements InputFilterProviderInterface
{
    
    /**
     * 
     * @var AuthenticationServiceInterface
     */
    protected $authService;
    
    /**
     * 
     * @param string $name
     * @param array $options
     * @return \Employee\Form\PasswordForm
     */
    function __construct(AuthServiceInterface $authService, $name = 'employee-password-form', $options = array())
    {
        
        $this->authService = $authService;
        
        parent::__construct($name, $options);
        
        // employeeId
        $this->add(array(
            'name' => 'employeeId',
            'type' => 'hidden'
        ));
        
        // oldPassword
        $this->add(array(
            'name' => 'oldPassword',
            'type' => 'Password',
            'options' => array(
                'label' => 'Old Password:',
                
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'oldPassword',
                'placeholder' => 'Password'
            )
        ));
        
        // newPassword
        $this->add(array(
            'name' => 'newPassword',
            'type' => 'Password',
            'options' => array(
                'label' => 'New Password:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'newPassword',
                'placeholder' => 'Password'
            )
        ));
        
        // confirmPassword
        $this->add(array(
            'name' => 'confirmPassword',
            'type' => 'Password',
            'options' => array(
                'label' => 'Confirm Password:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'confirmPassword',
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
     * {@inheritDoc}
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
            
            // oldPassword
            'oldPassword' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Old Password is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'Auth\Validator\OldPassword',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'authService' => $this->authService
                        )
                    )
                )
            ),
            
            
            // newPassword
            'newPassword' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The New Password is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'Auth\Validator\PasswordStrength',
                        'break_chain_on_failure' => true,
                    )
                )
            ),
            
            // confirmPassword
            'confirmPassword' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Confirm Password is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'Identical',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'token' => 'newPassword',
                            'messages' => array(
                                \Zend\Validator\Identical::NOT_SAME => 'The Confirm Password dose not match your new password'
                            )
                        )
                        
                    )
                )
            ),
        );
        
    }

}