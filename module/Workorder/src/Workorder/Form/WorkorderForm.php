<?php
namespace Workorder\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Workorder\Entity\WorkorderEntity;
use Workorder\Hydrator\WorkorderHydrator;
use Location\Service\LocationServiceInterface;

class WorkorderForm extends Form implements InputFilterProviderInterface
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
     * @return \Workorder\Form\WorkorderForm
     */
    function __construct(LocationServiceInterface $locationService, $name = 'workrder-form', $options = array())
    {
        $this->locationService = $locationService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new WorkorderHydrator(false));
        
        $this->setObject(new WorkorderEntity());
        
        // workorderId
        $this->add(array(
            'name' => 'workorderId',
            'type' => 'hidden'
        ));
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden',
        ));
        
        // userId
        $this->add(array(
            'name' => 'userId',
            'type' => 'hidden',
        ));
        
        // phoneId
        $this->add(array(
            'name' => 'phoneId',
            'type' => 'hidden',
        ));
        
        // invoiceId
        $this->add(array(
            'name' => 'invoiceId',
            'type' => 'hidden',
        ));
        
        // workorderLabor
        $this->add(array(
            'name' => 'workorderLabor',
            'type' => 'hidden',
        ));
        
        // workorderParts
        $this->add(array(
            'name' => 'workorderParts',
            'type' => 'hidden',
        ));
        
        // workorderDateCreate
        $this->add(array(
            'name' => 'workorderDateCreate',
            'type' => 'hidden',
        ));
        
        // workorderDateEnd
        $this->add(array(
            'name' => 'workorderDateEnd',
            'type' => 'hidden',
        ));
        
        // workorderDateClose
        $this->add(array(
            'name' => 'workorderDateClose',
            'type' => 'hidden',
        ));
        
        
        
        // workorderStatus
        $this->add(array(
            'type' => 'Select',
            'name' => 'workorderStatus',
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
                'id' => 'workorderStatus'
            )
        ));
        
        // workorderDateScheduled
        $this->add(array(
            'name' => 'workorderDateScheduled',
            'type' => 'Text',
            'options' => array(
                'label' => 'Schedule:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderDateScheduled'
            )
        ));
        
        // workorderDescription
        $this->add(array(
            'name' => 'workorderDescription',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Description:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderDescription'
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
            // workorderId
            'workorderId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Id is required and cannot be empty."
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
            
            // phoneId
            'phoneId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Phone Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderLabor
            'workorderLabor' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Labor is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderParts
            'workorderParts' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Parts is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderDateCreate
            'workorderDateCreate' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Create Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderDateEnd
            'workorderDateCreate' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order End Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderDateClose
            'workorderDateCreate' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Close Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderStatus
            'workorderStatus' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Status is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            
            // workorderDateScheduled
            'workorderDateScheduled' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Date Scheduled is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderDescription
            'workorderDescription' => array(
                'required' => true,
                'filters' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Description is required and cannot be empty."
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