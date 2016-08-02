<?php
namespace TicketNote\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use TicketNote\View\Helper\TicketNoteViewHelper;

class TicketNoteViewHelperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \TicketNote\View\Helper\TicketNoteViewHelper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $noteService = $realServiceLocator->get('TicketNote\Service\NoteServiceInterface');
     
        
        return new TicketNoteViewHelper($noteService);
    }
}

