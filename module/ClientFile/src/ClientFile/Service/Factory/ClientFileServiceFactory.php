<?php
namespace ClientFile\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ClientFile\Service\ClientFileService;

class ClientFileServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \ClientFile\Service\ClientFileService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('ClientFile\Mapper\ClientFileMapperInterface');
        
        return new ClientFileService($mapper);
    }
}