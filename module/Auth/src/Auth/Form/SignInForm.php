<?php
namespace Auth\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Auth\Hydrator\AuthHydrator;
use Auth\Entity\AuthEntity;

class SignInForm extends Form implements InputFilterProviderInterface
{

    function __construct($name = 'sign-in-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new AuthHydrator(false));
        
        $this->setObject(new AuthEntity());
        
        
        // authEmail
        $this->add(array(
            'name' => 'authEmail',
            'type' => 'Text',
            'options' => array(
                'label' => 'Email:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'authEmail',
                'placeholder' => 'Email',
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
                'value' => 'Sign In',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-block btn-flat'
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "Email Address is required and cannot be empty"
                            )
                        )
                    )
                )
            ),
            
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "Password is required and cannot be empty"
                            )
                        )
                    )
                )
            )
        );
    }
}