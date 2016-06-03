<?php
namespace WorkorderNote\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderNote\Controller\CreateController;

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
        
        $noteService = $realServiceLocator->get('WorkorderNote\Service\NoteServiceInterface');
        
        $noteForm = $realServiceLocator->get('WorkorderNote\Form\NoteForm');
        
        return new CreateController($noteService, $noteForm);
    }
}
