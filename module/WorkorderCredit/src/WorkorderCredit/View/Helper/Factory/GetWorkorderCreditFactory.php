<?php
namespace WorkorderCredit\View\Helper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCredit\View\Helper\GetWorkorderCredit;

class GetWorkorderCreditFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        
        $creditService = $realServiceLocator->get('WorkorderCredit\Service\CreditServiceInterface');
        
        return new GetWorkorderCredit($creditService);
    }
}