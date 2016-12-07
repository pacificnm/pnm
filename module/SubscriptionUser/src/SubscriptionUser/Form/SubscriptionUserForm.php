<?php
namespace SubscriptionUser\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use User\Service\UserServiceInterface;
use SubscriptionUser\Hydrator\SubscriptionUserHydrator;
use SubscriptionUser\Entity\SubscriptionUserEntity;

class SubscriptionUserForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     *
     * @param UserServiceInterface $userService            
     * @param string $name            
     * @param array $options            
     */
    public function __construct(UserServiceInterface $userService, $name = 'subscription-user-form', $options = array())
    {
        $this->userService = $userService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new SubscriptionUserHydrator(false));
        
        $this->setObject(new SubscriptionUserEntity());
        
        // subscriptionHostId
        $this->add(array(
            'name' => 'subscriptionUserId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'subscriptionUserId'
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
        
        // subscriptionUserCreate
        $this->add(array(
            'name' => 'subscriptionUserCreate',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'subscriptionUserCreate'
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
     * @return \SubscriptionUser\Form\SubscriptionUserForm
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
     * @param number $clientId            
     * @return \SubscriptionUser\Form\SubscriptionUserForm
     */
    public function getClientUsers($clientId)
    {
        $this->setClientId($clientId);
        
        // hostId
        $this->add(array(
            'name' => 'userId',
            'type' => 'select',
            'options' => array(
                'label' => 'User:',
                'value_options' => $this->getUserOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'userId'
            )
        ));
        
        return $this;
    }

    /**
     *
     * @return string[]
     */
    protected function getUserOptions()
    {
        $entitys = $this->userService->getAll(array(
            'pagination' => 'off',
            'userStatus' => 'Active',
            'clientId' => $this->getClientId()
        ));
        
        $options = array();
        
        foreach ($entitys as $entity) {
            $options[$entity->getUserId()] = $entity->getUserNameFirst() . ' ' . $entity->getUserNameLast();
        }
        
        return $options;
    }
}

