<?php
namespace TaskNote\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use TaskNote\Hydrator\NoteHydrator;
use TaskNote\Entity\NoteEntity;


class NoteForm extends Form implements InputFilterProviderInterface
{
    
    public function __construct($name = 'note-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new NoteHydrator(false));
        
        $this->setObject(new NoteEntity());
        
        // taskNoteId
        $this->add(array(
            'name' => 'taskNoteId',
            'type' => 'hidden'
        ));
        
        // taskId
        $this->add(array(
            'name' => 'taskId',
            'type' => 'hidden'
        ));
        
        // employeeId
        $this->add(array(
            'name' => 'employeeId',
            'type' => 'hidden'
        ));
        
        // taskNoteDate
        $this->add(array(
            'name' => 'taskNoteDate',
            'type' => 'hidden'
        ));
        
        // taskNoteText
        $this->add(array(
            'name' => 'taskNoteText',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Note:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'taskNoteText'
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
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array();
        
    }

    
}