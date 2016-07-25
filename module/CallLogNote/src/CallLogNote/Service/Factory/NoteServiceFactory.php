<?php
namespace CallLogNote\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use CallLogNote\Service\NoteService;

class NoteServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \CallLogNote\Service\NoteService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('CallLogNote\Mapper\NoteMapperInterface');
        
        return new NoteService($mapper);
    }
}

