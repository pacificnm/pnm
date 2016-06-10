<?php
namespace WorkorderCredit\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCredit\Controller\CreateController;

class CreateControllerFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $creditService = $realServiceLocator->get('WorkorderCredit\Service\CreditServiceInterface');
        
        $creditForm = $realServiceLocator->get('WorkorderCredit\Form\CreditForm');
        
        return new CreateController($clientService, $workorderService, $creditService, $creditForm);
    }
}
