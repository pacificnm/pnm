<?php
namespace Subscription\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Subscription\Form\SubscriptionForm;

class SubscriptionFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Subscription\Form\SubscriptionForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $optionService = $serviceLocator->get('PaymentOption\Service\OptionServiceInterface');
        
        $subscriptionScheduleService = $serviceLocator->get('SubscriptionSchedule\Service\SubscriptionScheduleServiceInterface');
        
        $subscriptionStatusService = $serviceLocator->get('SubscriptionStatus\Service\SubscriptionStatusServiceInterface');
        
        return new SubscriptionForm($optionService, $subscriptionScheduleService, $subscriptionStatusService);
    }
}