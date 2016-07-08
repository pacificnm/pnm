<?php
namespace Task\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use TaskPriority\Service\PriorityServiceInterface;
use Task\Hydrator\TaskHydrator;
use Task\Entity\TaskEntity;
use Employee\Service\EmployeeServiceInterface;

class TaskForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @var PriorityServiceInterface
     */
    protected $priorityService;

    /**
     *
     * @var EmployeeServiceInterface
     */
    protected $employeeService;

    /**
     *
     * @param PriorityServiceInterface $priorityService            
     * @param EmployeeServiceInterface $employeeService            
     * @param string $name            
     * @param array $options            
     */
    public function __construct(PriorityServiceInterface $priorityService, EmployeeServiceInterface $employeeService, $name = 'task-form', $options = array())
    {
        $this->priorityService = $priorityService;
        
        $this->employeeService = $employeeService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new TaskHydrator(false));
        
        $this->setObject(new TaskEntity());
        
        // taskId
        $this->add(array(
            'name' => 'taskId',
            'type' => 'hidden'
        ));
        
        // taskDateReminderActive
        $this->add(array(
            'name' => 'taskDateReminderActive',
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
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden'
        ));
        
        // taskDateStart
        $this->add(array(
            'name' => 'taskDateStart',
            'type' => 'Text',
            'options' => array(
                'label' => 'Date Start:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'taskDateStart'
            )
        ));
        
        // taskDateEnd
        $this->add(array(
            'name' => 'taskDateEnd',
            'type' => 'Text',
            'options' => array(
                'label' => 'Due Date:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'taskDateEnd'
            )
        ));
        
        // taskStatus
        $this->add(array(
            'type' => 'Select',
            'name' => 'taskStatus',
            'options' => array(
                'label' => 'Status:',
                'value_options' => array(
                    'Active' => 'Active',
                    'Closed' => 'Closed'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'taskStatus'
            )
        ));
        
        // taskPriorityId
        $this->add(array(
            'type' => 'Select',
            'name' => 'taskPriorityId',
            'options' => array(
                'label' => 'Priority:',
                'value_options' => $this->getPriorityOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'taskPriorityId'
            )
        ));
        
        // taskDateReminder
        $this->add(array(
            'name' => 'taskDateReminder',
            'type' => 'Select',
            'options' => array(
                'label' => 'Reminder:',
                'value_options' => array(
                    '5' => '5 Min',
                    '10' => '10 Min',
                    '15' => '15 Min',
                    '30' => '30 Min',
                    '60' => '1 Hr'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'taskDateReminder'
            )
        ));
        
        // taskTitle
        $this->add(array(
            'name' => 'taskTitle',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'taskTitle'
            )
        ));
        
        // taskDescription
        $this->add(array(
            'name' => 'taskDescription',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Description:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'taskDescription'
            )
        ));
        
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
            // taskId
            'taskId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Task Id is required and cannot be empty."
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
            
            // taskDateStart
            'taskDateStart' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Task Start Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // taskDateEnd
            'taskDateEnd' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Task Due Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // taskStatus
            'taskStatus' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Task Status is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // taskPriorityId
            'taskPriorityId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Task Priority is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // taskDateReminder
            'taskDateReminder' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Task Reminder is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // taskTitle
            'taskTitle' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Task Title is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // taskDescription
            'taskDescription' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Task Description is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // taskDateReminderActive
            'taskDateReminderActive' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Task Reminder Active is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
    }

    /**
     */
    private function getPriorityOptions()
    {
        $options = array();
        
        $entitys = $this->priorityService->getAll(array());
        
        foreach ($entitys as $entity) {
            $options[$entity->getTaskPriorityId()] = $entity->getTaskPriorityValue();
        }
        
        return $options;
    }

    private function getEmployeeOptions()
    {
        $options = array();
        
        $entitys = $this->employeeService->getAll(array());
        
        foreach ($entitys as $entity) {
            $options[$entity->getEmployeeId()] = $entity->getEmployeeName();
        }
        
        return $options;
    }
}
