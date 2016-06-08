<?php
namespace WorkorderTime\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Employee\Service\EmployeeServiceInterface;
use WorkorderTime\Hydrator\TimeHydrator;
use WorkorderTime\Entity\TimeEntity;
use Labor\Service\LaborServiceInterface;

class TimeForm extends Form implements InputFilterProviderInterface
{
    /**
     *
     * @var EmployeeServiceInterface
     */
    protected $employeeService;
    
    /**
     * 
     * @var LaborServiceInterface
     */
    protected $laborService;
    
    /**
     * 
     * @param EmployeeServiceInterface $employeeService
     * @param LaborServiceInterface $laborService
     * @param string $name
     * @param array $options
     * @return \WorkorderTime\Form\TimeForm
     */
    function __construct(EmployeeServiceInterface $employeeService, LaborServiceInterface $laborService, $name = 'workrder-note-form', $options = array())
    {
        $this->employeeService = $employeeService;
    
        $this->laborService = $laborService;
        
        parent::__construct($name, $options);
    
        $this->setHydrator(new TimeHydrator(false));
    
        $this->setObject(new TimeEntity());
    
        $this->setAttribute('method', 'POST');
     
        // workorderTimeId
        $this->add(array(
            'name' => 'workorderTimeId',
            'type' => 'hidden'
        ));
        
        // workorderId
        $this->add(array(
            'name' => 'workorderId',
            'type' => 'hidden'
        ));
        
        // workorderTimeIn
        $this->add(array(
            'name' => 'workorderTimeIn',
            'type' => 'Text',
            'options' => array(
                'label' => 'Time:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderTimeIn',
                'required' => true
            )
        ));
        
        // workorderTimeOut
        $this->add(array(
            'name' => 'workorderTimeOut',
            'type' => 'hidden'
        ));
        
        // workorderTimeTotal
        $this->add(array(
            'name' => 'workorderTimeTotal',
            'type' => 'hidden'
        ));
        
        // laborId
        $this->add(array(
            'type' => 'Select',
            'name' => 'laborId',
            'options' => array(
                'label' => 'Labor:',
                'value_options' => $this->getLaborOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'laborId'
            )
        ));
        
        // laborName
        $this->add(array(
            'name' => 'laborName',
            'type' => 'hidden'
        ));
        
        // laborRate
        $this->add(array(
            'name' => 'laborRate',
            'type' => 'hidden'
        ));
        
        // laborTotal
        $this->add(array(
            'name' => 'laborTotal',
            'type' => 'hidden'
        ));
        
        // employeeId
        $this->add(array(
            'type' => 'Select',
            'name' => 'employeeId',
            'options' => array(
                'label' => 'Employee:',
                'value_options' => $this->getEmployeeOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeId'
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
            // workorderTimeId
            'workorderTimeId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Time Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
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
            
            // workorderTimeIn
            'workorderTimeIn' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Time In is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderTimeOut
            'workorderTimeOut' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Time Out is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderTimeTotal
            'workorderTimeTotal' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Time Total is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // laborId
            'workorderTimeTotal' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Labor is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // laborName
            'laborName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Labor Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // laborRate
            'laborRate' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Labor Rate is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // laborTotal
            'laborTotal' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Labor Total is required and cannot be empty."
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Employee is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
        
    }
    
    private function getEmployeeOptions()
    {
        $options = array();
    
        $entitys = $this->employeeService->getAll(array());
    
        foreach($entitys as $entity) {
            $options[$entity->getEmployeeId()] = $entity->getEmployeeName();
        }
    
        return $options;
    }
    
    private function getLaborOptions()
    {
        $options = array();
        
        $entitys = $this->laborService->getAll(array());
        
        foreach($entitys as $entity) {
            $options[$entity->getLaborId()] = $entity->getLaborName() . ' ' . $entity->getLaborAmount();
        }
        
        return $options;
    }

}
