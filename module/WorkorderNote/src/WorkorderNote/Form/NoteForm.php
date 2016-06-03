<?php
namespace WorkorderNote\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Employee\Service\EmployeeServiceInterface;
use WorkorderNote\Hydrator\NoteHydrator;
use WorkorderNote\Entity\NoteEntity;

class NoteForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @var EmployeeServiceInterface
     */
    protected $employeeService;
    
    /**
     * 
     * @param EmployeeServiceInterface $employeeService
     * @param string $name
     * @param array $options
     * @return \WorkorderNote\Form\NoteForm
     */
    function __construct(EmployeeServiceInterface $employeeService, $name = 'workrder-note-form', $options = array())
    {
        $this->employeeService = $employeeService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new NoteHydrator(false));
        
        $this->setObject(new NoteEntity());
        
        $this->setAttribute('method', 'POST');
        
        
        
        // workorderNotesId
        $this->add(array(
            'name' => 'workorderNotesId',
            'type' => 'hidden'
        ));
        
        // workorderId
        $this->add(array(
            'name' => 'workorderId',
            'type' => 'hidden'
        ));
        
        // workorderNotesDate
        $this->add(array(
            'name' => 'workorderNotesDate',
            'type' => 'Text',
            'options' => array(
                'label' => 'Date:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderNotesDate',
                'required' => true
            )
        ));
        
        // workorderNotesNote
        $this->add(array(
            'name' => 'workorderNotesNote',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Note:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderNotesNote',
                'required' => true
            )
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
            
            // workorderNotesId
            'workorderNotesId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Note Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderNotesDate
            'workorderNotesDate' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Note Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderNotesNote
            'workorderNotesNote' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Note is required and cannot be empty."
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

}
