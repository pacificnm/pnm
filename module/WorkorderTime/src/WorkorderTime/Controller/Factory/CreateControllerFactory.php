<?php
namespace WorkorderTime\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderTime\Controller\CreateController;

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
        
        $timeService = $realServiceLocator->get('WorkorderTime\Service\TimeServiceInterface');
        
        $laborService = $realServiceLocator->get('Labor\Service\LaborServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $creditService = $realServiceLocator->get('WorkorderCredit\Service\CreditServiceInterface');
        
        $timeForm = $realServiceLocator->get('WorkorderTime\Form\TimeForm');
        
        return new CreateController($timeService, $laborService, $workorderService, $creditService, $timeForm);
    }
}