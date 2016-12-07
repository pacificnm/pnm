<?php
namespace SubscriptionHost\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Host\Service\HostServiceInterface;
use SubscriptionHost\Hydrator\SubscriptionHostHydrator;
use SubscriptionHost\Entity\SubscriptionHostEntity;

class SubscriptionHostForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @var HostServiceInterface
     */
    protected $hostService;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @param HostServiceInterface $hostService            
     * @param string $name            
     * @param array $options            
     */
    public function __construct(HostServiceInterface $hostService, $name = 'subscription-host-form', $options = array())
    {
        $this->hostService = $hostService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new SubscriptionHostHydrator(false));
        
        $this->setObject(new SubscriptionHostEntity());
        
        // subscriptionUserId
        $this->add(array(
            'name' => 'subscriptionHostId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'subscriptionHostId'
            )
        ));
        
        // subscriptionId
        $this->add(array(
            'name' => 'subscriptionId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'subscriptionId'
            )
        ));
        
        $this->add(array(
            'name' => 'subscriptionHostCreated',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'subscriptionHostCreated'
            )
        ));
        
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
     *
     * {@inheritdoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array();
    }

    /**
     *
     * @param number $clientId            
     * @return \SubscriptionHost\Form\SubscriptionHostForm
     */
    public function getClientHosts($clientId)
    {
        // hostId
        $this->add(array(
            'name' => 'hostId',
            'type' => 'select',
            'options' => array(
                'label' => 'Host:',
                'value_options' => $this->getHostOptions($clientId)
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
     * @param number $clientId            
     * @return \Host\Entity\the[]
     */
    protected function getHostOptions($clientId)
    {
        $entitys = $this->hostService->getAll(array(
            'pagination' => 'off',
            'hostStatus' => 'Active',
            'clientId' => $clientId
        ));
        
        $options = array();
        
        foreach ($entitys as $entity) {
            $options[$entity->getHostId()] = $entity->getHostName();
        }
        
        return $options;
    }
}

