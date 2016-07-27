<?php
namespace WorkorderHost\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use WorkorderHost\Hydrator\WorkorderHostHydrator;
use WorkorderHost\Entity\WorkorderHostEntity;
use Host\Service\HostServiceInterface;

class WorkorderHostForm extends Form implements InputFilterProviderInterface
{

    protected $hostService;

    protected $clientId;

    protected $workorderId;

    /**
     *
     * @param HostServiceInterface $hostService            
     * @param string $name            
     * @param array $options            
     * @return \WorkorderHost\Form\WorkorderHostForm
     */
    public function __construct(HostServiceInterface $hostService, $name = 'workrder-form', $options = array())
    {
        $this->hostService = $hostService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new WorkorderHostHydrator(false));
        
        $this->setObject(new WorkorderHostEntity());

    }
    
    /**
     *
     * @return \WorkorderHost\Form\WorkorderHostForm
     */
    public function getFormElements()
    {
        // workorderHostId
        $this->add(array(
            'name' => 'workorderHostId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'workorderHostId'
            )
        ));
        
        // workorderId
        $this->add(array(
            'name' => 'workorderId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'workorderHostId',
                'value' => $this->getWorkorderId()
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
        
        
        $this->setAttribute('method', 'post');
        
        // hostId
        $this->add(array(
            'type' => 'Select',
            'name' => 'hostId',
            'options' => array(
                'label' => 'Host:',
                'value_options' => $this->getHostSelectOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'hostId'
            )
        ));
        
        
        
        return $this;
    }

    /**
     *
     * @param unknown $clientId            
     * @return \WorkorderHost\Form\WorkorderHostForm
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        
        return $this;
    }

    /**
     *
     * @return number
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     *
     * @param number $workorderId            
     * @return \WorkorderHost\Form\WorkorderHostForm
     */
    public function setWorkorderId($workorderId)
    {
        $this->workorderId = $workorderId;
        
        return $this;
    }

    /**
     *
     * @return number
     */
    public function getWorkorderId()
    {
        return $this->workorderId;
    }

    /**
     *
     * {@inheritdoc}
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
            // hostId
            'hostId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Host Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
    }

    /**
     *
     * @return \Host\Entity\the[]
     */
    protected function getHostSelectOptions()
    {
        $options = array();
        
        $entitys = $this->hostService->getClientHostNotInWorkorder($this->getClientId(), $this->getClientId());
        
        foreach ($entitys as $entity) {
            $options[$entity->getHostId()] = $entity->getHostName();
        }
        
        return $options;
    }
}

