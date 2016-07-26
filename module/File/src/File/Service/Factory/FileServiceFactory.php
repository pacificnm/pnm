<?php
namespace File\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use File\Service\FileService;

class FileServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \File\Service\FileService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('File\Mapper\FileMapperInterface');
        
        return new FileService($mapper);
    }
}

