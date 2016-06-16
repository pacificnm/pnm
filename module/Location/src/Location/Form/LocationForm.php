<?php
namespace Location\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Location\Hydrator\LocationHydrator;
use Location\Entity\LocationEntity;
use Location\Service\LocationServiceInterface;

class LocationForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @var LocationServiceInterface
     */
    protected $locationService;
    
    protected $clientId;
    
    /**
     * 
     * @param LocationServiceInterface $locationService
     * @param string $name
     * @param array $options
     * @return \Location\Form\LocationForm
     */
    function __construct(LocationServiceInterface $locationService, $name = 'location-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new LocationHydrator(false));
        
        $this->setObject(new LocationEntity());
        
        $this->locationService = $locationService;
        
        // locationId
        $this->add(array(
            'name' => 'locationId',
            'type' => 'hidden'
        ));
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden'
        ));
        
        // locationType
        $this->add(array(
            'type' => 'Select',
            'name' => 'locationType',
            'options' => array(
                'label' => 'Type:',
                'value_options' => array(
                    'Primary' => 'Primary',
                    'Branch Office' => 'Branch Office',
                    'Billing' => 'Billing',
                    'Shipping' => 'Shipping',
                    'Service' => 'Service'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'locationType'
            )
        ));
        
        // locationStreet
        $this->add(array(
            'name' => 'locationStreet',
            'type' => 'Text',
            'options' => array(
                'label' => 'Street:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'locationStreet'
            )
        ));
        
        // locationStreet2
        $this->add(array(
            'name' => 'locationStreet2',
            'type' => 'Text',
            'options' => array(
                'label' => 'Street Cont:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'locationStreet2'
            )
        ));
        
        // locationCity
        $this->add(array(
            'name' => 'locationCity',
            'type' => 'Text',
            'options' => array(
                'label' => 'City:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'locationCity'
            )
        ));
        
        // locationState
        $this->add(array(
            'name' => 'locationState',
            'type' => 'Text',
            'options' => array(
                'label' => 'State:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'locationState'
            )
        ));
        
        // locationZip
        $this->add(array(
            'name' => 'locationZip',
            'type' => 'Text',
            'options' => array(
                'label' => 'Postal Code:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'locationZip'
            )
        ));
        
        // locationStatus
        $this->add(array(
            'type' => 'Select',
            'name' => 'locationStatus',
            'options' => array(
                'label' => 'Status:',
                'value_options' => array(
                    'Active' => 'Active',
                    'Closed' => 'Closed'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'locationStatus'
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
            // locationId
            'locationId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Location Id is required and cannot be empty."
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
            
            // locationType
            'locationType' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Location Type is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'Location\Validator\HasPrimary',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'locationService' => $this->locationService,
                            'clientId' => $this->clientId
                        )
                    )
                )
            ),
            
            // locationStreet
            'locationStreet' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Location Street is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // locationStreet2
            'locationStreet2' => array(
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
            
            // locationCity
            'locationCity' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Location City is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // locationState
            'locationState' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Location State is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // locationZip
            'locationZip' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Location Postal Code is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // locationStatus
            'locationStatus' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Location Status is required and cannot be empty."
                            )
                        )
                    )
                )
            )
        );
    }
    
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }
}