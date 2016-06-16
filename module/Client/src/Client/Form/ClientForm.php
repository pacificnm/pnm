<?php
namespace Client\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Client\Hydrator\ClientHydrator;
use Client\Entity\ClientEntity;

class ClientForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     * @return \Client\Form\ClientForm
     */
    function __construct($name = 'client-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new ClientHydrator(false));
        
        $this->setObject(new ClientEntity());
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden'
        ));
        
        // clientName
        $this->add(array(
            'name' => 'clientName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Client Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'phoneNum'
            )
        ));
        
        // clientStatus
        $this->add(array(
            'type' => 'Select',
            'name' => 'clientStatus',
            'options' => array(
                'label' => 'Status:',
                'value_options' => array(
                    'Active' => 'Active',
                    'Closed' => 'Closed'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'clientStatus'
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
            
            // clientName
            'clientName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Client Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // clientStatus
            'clientStatus' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Client Status is required and cannot be empty."
                            )
                        )
                    )
                )
            )
        );
    }
}