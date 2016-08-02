<?php
namespace TicketNote\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use TicketNote\Hydrator\NoteHydrator;
use TicketNote\Entity\NoteEntity;

class UserForm extends Form implements InputFilterProviderInterface
{
    public function __construct($name = 'ticket-form', $options = array())
    {
        parent::__construct($name, $options);
    
        $this->setHydrator(new NoteHydrator(false));
    
        $this->setObject(new NoteEntity());
    
        // ticketNoteId
        $this->add(array(
            'name' => 'ticketNoteId',
            'type' => 'hidden'
        ));
    
        // ticketId
        $this->add(array(
            'name' => 'ticketId',
            'type' => 'hidden'
        ));
    
        // authId
        $this->add(array(
            'name' => 'authId',
            'type' => 'hidden'
        ));
    
        // ticketNoteClientView
        $this->add(array(
            'name' => 'ticketNoteClientView',
            'type' => 'hidden'
        ));
    
        // ticketNoteDateCreate
        $this->add(array(
            'name' => 'ticketNoteDateCreate',
            'type' => 'hidden'
        ));
    
        // ticketNoteText
        $this->add(array(
            'name' => 'ticketNoteText',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Note:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'ticketNoteText'
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
            // ticketNoteId
            'ticketNoteId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Ticket Note Id is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'IsInt',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\IsInt::NOT_INT => 'The Ticket Note Id must be an integer.',
                                \Zend\I18n\Validator\IsInt::INVALID => 'The Ticket Note Id must be an integer.'
                            )
                        )
                    )
                )
            ),
            
            // ticketId
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
            
            // authId
            'authId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Id is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'IsInt',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\IsInt::NOT_INT => 'The Auth Id must be an integer.',
                                \Zend\I18n\Validator\IsInt::INVALID => 'The Auth Id must be an integer.'
                            )
                        )
                    )
                )
            ),
            
            // ticketNoteClientView
            'ticketNoteClientView' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Note Client View is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'IsInt',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\IsInt::NOT_INT => 'The Note Client View must be an integer.',
                                \Zend\I18n\Validator\IsInt::INVALID => 'The Note Client View must be an integer.'
                            )
                        )
                    )
                )
            ),
            
            // ticketNoteDateCreate
            'ticketNoteDateCreate' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Note Date Create is required and cannot be empty."
                            )
                        )
                    ),
                    array(
                        'name' => 'IsInt',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\I18n\Validator\IsInt::NOT_INT => 'The Note Date Create must be an integer.',
                                \Zend\I18n\Validator\IsInt::INVALID => 'The Note Date Create must be an integer.'
                            )
                        )
                    )
                )
            ),
            
            // ticketNoteText
            'ticketNoteText' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Note is required and cannot be empty."
                            )
                        )
                    )
                )
            )
            
        );
        
    }

}

