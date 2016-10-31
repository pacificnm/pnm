<?php
namespace Subscription\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Subscription\Hydrator\SubscriptionHydrator;
use Subscription\Entity\SubscriptionEntity;

class SubscriptionForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @param string $name
     * @param array $options
     */
    public function __construct($name = 'subscription-form', $options = array())
    {
        parent::__construct($name, $options);
    
        $this->setHydrator(new SubscriptionHydrator(false));
    
        $this->setObject(new SubscriptionEntity());
        
        // submit button
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        // TODO Auto-generated method stub
        
    }

}