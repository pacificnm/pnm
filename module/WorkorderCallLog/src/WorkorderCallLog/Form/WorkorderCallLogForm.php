<?php
namespace WorkorderCallLog\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use WorkorderCallLog\Hydrator\WorkorderCallLogHydrator;
use WorkorderCallLog\Entity\WorkorderCallLogEntity;
use Workorder\Service\WorkorderServiceInterface;

class WorkorderCallLogForm extends Form implements InputFilterProviderInterface
{

    protected $workorderService;

    protected $clientId;

    /**
     *
     * @param WorkorderServiceInterface $workorderService            
     * @param string $name            
     * @param array $options            
     */
    public function __construct(WorkorderServiceInterface $workorderService, $name = 'workrder-form', $options = array())
    {
        $this->workorderService = $workorderService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new WorkorderCallLogHydrator(false));
        
        $this->setObject(new WorkorderCallLogEntity());
        
        // workorderCallLogId
        $this->add(array(
            'name' => 'workorderCallLogId',
            'type' => 'hidden'
        ));
        
        // callLogId
        $this->add(array(
            'name' => 'callLogId',
            'type' => 'hidden'
        ));
        
        // workorderCallLogCreated
        $this->add(array(
            'name' => 'workorderCallLogCreated',
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
     * @return \WorkorderCallLog\Form\WorkorderCallLogForm
     */
    public function setWorkorders()
    {
        // workorderId
        $this->add(array(
            'type' => 'Select',
            'name' => 'workorderId',
            'options' => array(
                'label' => 'Work Order:',
                'value_options' => $this->getSelectOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderId'
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
            // workorderCallLogId
            'workorderCallLogId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Call Log Id is required and cannot be empty."
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Call Log Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderCallLogCreated
            'workorderCallLogCreated' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Call Log Create is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        ) ;
    }

    /**
     *
     * @return string[]
     */
    protected function getSelectOptions()
    {
        $workorderEntitys = $this->workorderService->getClientActiveWorkOrders($this->getClientId());
        
        $options = array();
        
        foreach ($workorderEntitys as $workorderEntity) {
            $options[$workorderEntity->getWorkorderId()] = 'Workorder #' . $workorderEntity->getWorkorderId();
        }
        
        return $options;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        
        return $this;
    }

    public function getClientId()
    {
        return $this->clientId;
    }
}