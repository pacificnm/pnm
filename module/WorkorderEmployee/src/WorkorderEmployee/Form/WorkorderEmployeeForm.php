<?php
namespace WorkorderEmployee\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Employee\Service\EmployeeServiceInterface;
use WorkorderEmployee\Hydrator\WorkorderEmployeeHydrator;
use WorkorderEmployee\Entity\WorkorderEmployeeEntity;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;

class WorkorderEmployeeForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @var EmployeeServiceInterface
     */
    protected $employeeService;

    /**
     * 
     * @var WorkorderEmployeeServiceInterface
     */
    protected $workorderEmployeeService;
    
    /**
     * 
     * @param EmployeeServiceInterface $employeeService
     * @param WorkorderEmployeeServiceInterface $workorderEmployeeService
     * @param string $name
     * @param array $options
     * @return \WorkorderEmployee\Form\WorkorderEmployeeForm
     */
    function __construct(EmployeeServiceInterface $employeeService, WorkorderEmployeeServiceInterface $workorderEmployeeService, $name = 'workrder-form', $options = array())
    {
        $this->employeeService = $employeeService;
        
        $this->workorderEmployeeService = $workorderEmployeeService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new WorkorderEmployeeHydrator(false));
        
        $this->setObject(new WorkorderEmployeeEntity());
        
        // workorderEmployeeId
        $this->add(array(
            'name' => 'workorderEmployeeId',
            'type' => 'hidden'
        ));
        
        // workorderId
        $this->add(array(
            'name' => 'workorderId',
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
            
            // workorderEmployeeId
            'workorderEmployeeId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Employee Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The mployee Id is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'WorkorderEmployee\Validator\HasEmployee',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'employeeService' => $this->workorderEmployeeService,
                        )
                    )
                )
            ),
        );
    }

    /**
     */
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