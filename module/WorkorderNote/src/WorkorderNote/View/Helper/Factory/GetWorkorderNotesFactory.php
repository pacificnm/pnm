<?php
namespace WorkorderNote\View\Helper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderNote\View\Helper\GetWorkorderNotes;

class GetWorkorderNotesFactory implements FactoryInterface
{
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $noteService = $realServiceLocator->get('WorkorderNote\Service\NoteServiceInterface');
        
        return new GetWorkorderNotes($noteService);
    }
}
