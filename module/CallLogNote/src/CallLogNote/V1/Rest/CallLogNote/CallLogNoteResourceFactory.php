<?php
namespace CallLogNote\V1\Rest\CallLogNote;

use Zend\ServiceManager\ServiceLocatorInterface;

class CallLogNoteResourceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $services            
     * @return \CallLogNote\V1\Rest\CallLogNote\CallLogNoteResource
     */
    public function __invoke(ServiceLocatorInterface $services)
    {
        $noteService = $services->get('CallLogNote\Service\NoteServiceInterface');
        
        return new CallLogNoteResource($noteService);
    }
}
