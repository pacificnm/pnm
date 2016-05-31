<?php
namespace Labor\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Labor\Controller\UpdateController;
use Labor\Form\LaborForm;

class UpdateControllerFactory implements FactoryInterface
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
        
        $laborService = $realServiceLocator->get('Labor\Service\LaborServiceInterface');
        
        $laborForm = new LaborForm();
        
        return new UpdateController($laborService, $laborForm);
    }
}