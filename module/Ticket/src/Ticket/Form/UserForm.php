<?php
namespace Ticket\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Ticket\Hydrator\TicketHydrator;
use Ticket\Entity\TicketEntity;

class UserForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     * @return \Ticket\Form\UserForm
     */
    public function __construct($name = 'ticket-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new TicketHydrator(false));
        
        $this->setObject(new TicketEntity());
        
        // ticketId;
        $this->add(array(
            'name' => 'ticketId',
            'type' => 'hidden'
        ));
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden'
        ));
        
        // userId
        $this->add(array(
            'name' => 'userId',
            'type' => 'hidden'
        ));
        
        // ticketTitle
        $this->add(array(
            'name' => 'ticketTitle',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'ticketTitle'
            )
        ));
        
        // ticketStatus
        $this->add(array(
            'name' => 'ticketStatus',
            'type' => 'hidden'
        ));
        
        // ticketDateOpen
        $this->add(array(
            'name' => 'ticketDateOpen',
            'type' => 'hidden'
        ));
        
        // ticketDateClose
        $this->add(array(
            'name' => 'ticketDateClose',
            'type' => 'hidden'
        ));
        
        // ticketText
        $this->add(array(
            'name' => 'ticketText',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Description:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'ticketText'
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
     * {@inheritdoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // ticketId;
            'ticketId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Ticket Id is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'IsInt',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\IsInt::NOT_INT => 'The Ticket Id must be an integer.',
                                \Zend\I18n\Validator\IsInt::INVALID => 'The Ticket Id must be an integer.'
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
                    ),
                    array(
                        'name' => 'IsInt',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\IsInt::NOT_INT => 'The Client Id must be an integer.',
                                \Zend\I18n\Validator\IsInt::INVALID => 'The Client Id must be an integer.'
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Client Id is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'IsInt',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\IsInt::NOT_INT => 'The User Id must be an integer.',
                                \Zend\I18n\Validator\IsInt::INVALID => 'The User Id must be an integer.'
                            )
                        )
                    )
                )
            ),
            
            // ticketTitle
            'ticketTitle' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Ticket Title is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'StringLength',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'min' => 5,
                            'max' => 255,
                            'messages' => array(
                                \Zend\Validator\StringLength::TOO_LONG => "The Ticket Title must be less than 256 characters.",
                                \Zend\Validator\StringLength::TOO_SHORT => "The Ticket Title must be more than 4 charatcters.",
                                \Zend\Validator\StringLength::INVALID => "The Ticket Title muct be between 5 and 255 characters."
                            )
                        )
                    )
                )
            ),
            
            // ticketStatus
            'ticketStatus' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Ticket Status is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'InArray',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'haystack' => array(
                                'New',
                                'Active',
                                'Closed'
                            ),
                            'strict' => \Zend\Validator\InArray::COMPARE_NOT_STRICT,
                            'messages' => array(
                                \Zend\Validator\InArray::NOT_IN_ARRAY => "The Ticket Status must be one of the following: 'New', 'Active' or 'Closed'."
                            )
                        )
                    )
                )
            ),
            
            // ticketDateOpen
            'ticketDateOpen' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Ticket Date Opened is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'IsInt',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\IsInt::NOT_INT => 'The Ticket Date Opened must be an integer.',
                                \Zend\I18n\Validator\IsInt::INVALID => 'The Ticket Date Opened must be an integer.'
                            )
                        )
                    )
                )
            ),
            
            // ticketDateClose
            'ticketDateClose' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Ticket Date Closed is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'IsInt',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\IsInt::NOT_INT => 'The Ticket Date Closed must be an integer.',
                                \Zend\I18n\Validator\IsInt::INVALID => 'The Ticket Date Closed must be an integer.'
                            )
                        )
                    )
                )
            ),
            
            // ticketText
            'ticketText' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Ticket Description is required and cannot be empty."
                            )
                        )
                    )
                )
            )
        );
    }
}

