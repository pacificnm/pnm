<?php
namespace WorkorderPart\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use WorkorderPart\Hydrator\PartHydrator;
use WorkorderPart\Entity\PartEntity;

class PartForm extends Form implements InputFilterProviderInterface
{
    function __construct($name = 'workrder-note-form', $options = array())
    {
    
        parent::__construct($name, $options);
    
        $this->setHydrator(new PartHydrator(false));
    
        $this->setObject(new PartEntity());
    
        $this->setAttribute('method', 'POST');
         
        // workorderPartsId
        $this->add(array(
            'name' => 'workorderPartsId',
            'type' => 'hidden'
        ));
    
        // workorderId
        $this->add(array(
            'name' => 'workorderId',
            'type' => 'hidden'
        ));
        
        // workorderPartsQty
        $this->add(array(
            'name' => 'workorderPartsQty',
            'type' => 'Text',
            'options' => array(
                'label' => 'Qty:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderPartsQty',
                'required' => true
            )
        ));
        
        // workorderPartsDescription
        $this->add(array(
            'name' => 'workorderPartsDescription',
            'type' => 'Text',
            'options' => array(
                'label' => 'Description:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderPartsDescription',
                'required' => true
            )
        ));
        
        // workorderPartsAmount
        $this->add(array(
            'name' => 'workorderPartsAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Amount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderPartsAmount',
                'required' => true
            )
        ));
        
        // workorderPartsTotal
        $this->add(array(
            'name' => 'workorderPartsTotal',
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
        return array();
        
    }

}