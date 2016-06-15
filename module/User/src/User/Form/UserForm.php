<?php
namespace User\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Location\Service\LocationServiceInterface;
use User\Hydrator\UserHydrator;
use User\Entity\UserEntity;

class UserForm extends Form implements InputFilterProviderInterface
{
    /**
     *
     * @var LocationServiceInterface
     */
    protected $locationService;
    
    /**
     * 
     * @var number
     */
    protected $clientId;
    
    function __construct(LocationServiceInterface $locationService, $name = 'user-form', $options = array())
    {
        $this->locationService = $locationService;
    
        parent::__construct($name, $options);
    
        $this->setHydrator(new UserHydrator(false));
    
        $this->setObject(new UserEntity());
        
        // userId
        $this->add(array(
            'name' => 'userId',
            'type' => 'hidden'
        ));
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden'
        ));
        
        // userStatus
        $this->add(array(
            'type' => 'Select',
            'name' => 'userStatus',
            'options' => array(
                'label' => 'Status:',
                'value_options' => array(
                    'Active' => 'Active',
                    'Deleted' => 'Deleted'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'userStatus'
            )
        ));
        
        // userNameFirst
        $this->add(array(
            'name' => 'userNameFirst',
            'type' => 'Text',
            'options' => array(
                'label' => 'First Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'userNameFirst'
            )
        ));
        
        // userNameLast
        $this->add(array(
            'name' => 'userNameLast',
            'type' => 'Text',
            'options' => array(
                'label' => 'Last Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'userNameLast'
            )
        ));
        
        // userJobTitle
        $this->add(array(
            'name' => 'userJobTitle',
            'type' => 'Text',
            'options' => array(
                'label' => 'Job Title:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'userJobTitle'
            )
        ));
        
        // userEmail
        $this->add(array(
            'name' => 'userEmail',
            'type' => 'Text',
            'options' => array(
                'label' => 'E-Mail:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'userEmail'
            )
        ));
        
        // userType
        $this->add(array(
            'type' => 'Select',
            'name' => 'userType',
            'options' => array(
                'label' => 'Type:',
                'value_options' => array(
                    'Primary' => 'Primary',
                    'Logon' => 'Logon',
                    'Staff' => 'Staff'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'userType'
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
    
    public function getLocation()
    {
        // locationId
        $this->add(array(
            'type' => 'Select',
            'name' => 'locationId',
            'options' => array(
                'label' => 'Location:',
                'value_options' => $this->getLocationOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'locationId'
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
            
            // userStatus
            'userStatus' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The User Status is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // userNameFirst
            'userNameFirst' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The User First Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // userNameLast
            'userNameLast' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The User Last Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // userJobTitle
            'userJobTitle' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The User Job Title is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // userEmail
            'userEmail' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The User E-Mail is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // userType
            'userType' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The User Type is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
        
    }
    
    /**
     *
     * @param number $clientId
     * @return \Workorder\Form\WorkorderForm
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    
        return $this;
    }
    
    /**
     *
     * @param number $clientId
     * @return array
     */
    private function getLocationOptions()
    {
        $options = array();
    
        $entitys = $this->locationService->getAll(array(
            'clientId' => $this->clientId
        ));
    
        foreach ($entitys as $entity) {
            $options[$entity->getLocationId()] = $entity->getLocationStreet() . ' ' . $entity->getLocationCity();
        }
    
        return $options;
    }

}