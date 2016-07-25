<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace CallLog\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use CallLog\Hydrator\LogHydrator;
use CallLog\Entity\LogEntity;
use Employee\Service\EmployeeServiceInterface;

class LogForm extends Form implements InputFilterProviderInterface
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
     * @return \CallLog\Form\LogForm
     */
    public function __construct(EmployeeServiceInterface $employeeService, $name = 'call-log-form', $options = array())
    {
        $this->employeeService = $employeeService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new LogHydrator(false));
        
        $this->setObject(new LogEntity());
        
        // callLogId
        $this->add(array(
            'name' => 'callLogId',
            'type' => 'hidden'
        ));
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden'
        ));
        
        // employeeId
        $this->add(array(
            'type' => 'Select',
            'name' => 'employeeId',
            'options' => array(
                'label' => 'Employee:',
                'value_options' => $this->getEmployeOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeId'
            )
        ));
        
        // callLogTime
        $this->add(array(
            'name' => 'callLogTime',
            'type' => 'Text',
            'options' => array(
                'label' => 'Call Time:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'callLogTime'
            )
        ));
        
        // callLogDetail
        $this->add(array(
            'name' => 'callLogDetail',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Detail:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'callLogDetail'
            )
        ));
        
        // callLogRequireCallBack
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'callLogRequireCallBack',
            'options' => array(
                'label' => 'Require Call Back',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));
        
        // callLogWillCallBack
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'callLogWillCallBack',
            'options' => array(
                'label' => 'Will Call Back',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));
        
        // callLogVoiceMail
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'callLogVoiceMail',
            'options' => array(
                'label' => 'Left Voice Mail',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));
        
        // callLogUrgent
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'callLogUrgent',
            'options' => array(
                'label' => 'Call Is Urgent',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));
        
        // callLogRead
        $this->add(array(
            'name' => 'callLogRead',
            'type' => 'hidden'
        ));
        
        // callLogCreatedBy
        $this->add(array(
            'name' => 'callLogCreatedBy',
            'type' => 'hidden'
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
            // callLogId
            'callLogId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Call Log Id is required and cannot be empty."
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
            
            // callLogTime
            'callLogTime' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Call Time is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'format' => 'm/d/Y h:i a'
                        )
                    )
                )
            ),
            
            // callLogDetail
            'callLogDetail' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Call Detail is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // callLogRequireCallBack
            'callLogRequireCallBack' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
            ),
            
            // callLogWillCallBack
            'callLogWillCallBack' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
            ),
            
            // callLogVoiceMail
            'callLogVoiceMail' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
            ),
            
            // callLogUrgent
            'callLogUrgent' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
            ),
            
            // callLogCreatedBy
            'callLogCreatedBy' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Call Log Created By is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // callLogRead
            'callLogRead' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Call Log Read is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
    }

    protected function getEmployeOptions()
    {
        $options = array();
        
        $entitys = $this->employeeService->getAll(array());
        
        foreach ($entitys as $entity) {
            $options[$entity->getEmployeeId()] = $entity->getEmployeeName();
        }
        
        return $options;
    }
}

?>