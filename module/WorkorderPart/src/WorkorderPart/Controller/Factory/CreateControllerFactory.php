<?php
namespace WorkorderPart\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderPart\Controller\CreateController;
use WorkorderPart\Form\PartForm;

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
        
        $partService = $realServiceLocator->get('WorkorderPart\Service\PartServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $partForm = new PartForm();
        
        return new CreateController($partService, $workorderService, $partForm);
    }
}
