<?php
namespace CallLogNote\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use CallLogNote\Hydrator\NoteHydrator;
use CallLogNote\Entity\NoteEntity;

class NoteForm extends Form implements InputFilterProviderInterface
{
    public function __construct($name = 'call-log-note-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new NoteHydrator(false));
        
        $this->setObject(new NoteEntity());
        
        // callLogNoteId
        $this->add(array(
            'name' => 'callLogNoteId',
            'type' => 'hidden'
        ));
        
        // callLogId
        $this->add(array(
            'name' => 'callLogId',
            'type' => 'hidden'
        ));
        
        // callLogNoteText
        $this->add(array(
            'name' => 'callLogNoteText',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Note:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'callLogNoteText'
            )
        ));
        
        // callLogNoteCreateBy
        $this->add(array(
            'name' => 'callLogNoteCreateBy',
            'type' => 'hidden'
        ));
        
        // callLogCreated
        $this->add(array(
            'name' => 'callLogCreated',
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
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        array(
            // callLogNoteId
            'callLogNoteId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Call Log Note Id is required and cannot be empty."
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Call Log Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // callLogNoteText
            'callLogNoteText' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Call Log Note Text is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // callLogNoteCreateBy
            'callLogNoteCreateBy' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Call Log Note Create By is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // callLogCreated
            'callLogCreated' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Call Log Note Created is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
        
    }

}