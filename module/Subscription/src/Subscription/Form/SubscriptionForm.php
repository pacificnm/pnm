<?php
namespace Subscription\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Subscription\Hydrator\SubscriptionHydrator;
use Subscription\Entity\SubscriptionEntity;
use PaymentOption\Service\OptionServiceInterface;
use SubscriptionSchedule\Service\SubscriptionScheduleServiceInterface;
use SubscriptionStatus\Service\SubscriptionStatusServiceInterface;

class SubscriptionForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @var OptionServiceInterface
     */
    protected $optionService;

    /**
     *
     * @var SubscriptionScheduleServiceInterface
     */
    protected $subscriptionScheduleService;

    /**
     *
     * @var SubscriptionStatusServiceInterface
     */
    protected $subscriptionStatusService;

    /**
     *
     * @param OptionServiceInterface $optionService            
     * @param SubscriptionScheduleServiceInterface $subscriptionScheduleService            
     * @param SubscriptionStatusServiceInterface $subscriptionStatusService            
     * @param string $name            
     * @param array $options            
     */
    public function __construct(OptionServiceInterface $optionService, SubscriptionScheduleServiceInterface $subscriptionScheduleService, SubscriptionStatusServiceInterface $subscriptionStatusService, $name = 'subscription-form', $options = array())
    {
        $this->optionService = $optionService;
        
        $this->subscriptionScheduleService = $subscriptionScheduleService;
        
        $this->subscriptionStatusService = $subscriptionStatusService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new SubscriptionHydrator(false));
        
        $this->setObject(new SubscriptionEntity());
        
        // subscriptionId
        $this->add(array(
            'name' => 'subscriptionId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'subscriptionId'
            )
        ));
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'clientId'
            )
        ));
        
        // subscriptionDateCreate
        $this->add(array(
            'name' => 'subscriptionDateCreate',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'subscriptionDateCreate'
            )
        ));
        
        // subscriptionDateUpdate
        $this->add(array(
            'name' => 'subscriptionDateUpdate',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'subscriptionDateUpdate'
            )
        ));
        
        // subscriptionDateDue
        $this->add(array(
            'name' => 'subscriptionDateDue',
            'type' => 'Text',
            'options' => array(
                'label' => 'Due Date:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'subscriptionDateDue'
            )
        ));
        
        // subscriptionDateEnd
        $this->add(array(
            'name' => 'subscriptionDateEnd',
            'type' => 'Text',
            'options' => array(
                'label' => 'End Date:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'subscriptionDateEnd'
            )
        ));
        
        // paymentOptionId
        $this->add(array(
            'name' => 'paymentOptionId',
            'type' => 'select',
            'options' => array(
                'label' => 'Payment:',
                'value_options' => $this->getPaymentOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'paymentOptionId'
            )
        ));
        
        // subscriptionScheduleId
        $this->add(array(
            'name' => 'subscriptionScheduleId',
            'type' => 'select',
            'options' => array(
                'label' => 'Schedule:',
                'value_options' => $this->getSubscriptionScheduleOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'subscriptionScheduleId'
            )
        ));
        
        // subscriptionStatusId
        $this->add(array(
            'name' => 'subscriptionStatusId',
            'type' => 'select',
            'options' => array(
                'label' => 'Status:',
                'value_options' => $this->getSubscriptionStatusOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'subscriptionStatusId'
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
        return array()
        // subscriptionId
        
        // clientId
        
        // subscriptionDateCreate
        
        // subscriptionDateDue
        
        // subscriptionDateUpdate
        
        // subscriptionDateEnd
        
        // paymentOptionId
        
        // subscriptionScheduleId
        
        // subscriptionStatusId
        
        // productId
        
        // nextProductd
        ;
    }

    /**
     *
     * @return \PaymentOption\Entity\the[]
     */
    protected function getPaymentOptions()
    {
        $entitys = $this->optionService->getActive();
        
        $options = array();
        
        foreach ($entitys as $entity) {
            $options[$entity->getPaymentOptionId()] = $entity->getPaymentOptionName();
        }
        
        return $options;
    }

    /**
     *
     * @return \SubscriptionSchedule\Entity\the[]
     */
    protected function getSubscriptionScheduleOptions()
    {
        $entitys = $this->subscriptionScheduleService->getActive();
        
        $options = array();
        
        foreach ($entitys as $entity) {
            $options[$entity->getSubscriptionScheduleId()] = $entity->getSubscriptionScheduleName();
        }
        
        return $options;
    }

    /**
     *
     * @return \SubscriptionStatus\Entity\the[]
     */
    protected function getSubscriptionStatusOptions()
    {
        $entitys = $this->subscriptionStatusService->getActive();
        
        $options = array();
        
        foreach ($entitys as $entity) {
            $options[$entity->getSubscriptionStatusId()] = $entity->getSubscriptionStatusName();
        }
        
        return $options;
    }
}