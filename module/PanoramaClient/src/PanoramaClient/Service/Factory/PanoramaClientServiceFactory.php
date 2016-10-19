<?php
namespace PanoramaClient\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PanoramaClient\Service\PanoramaClientService;

class PanoramaClientServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PanoramaClient\Service\PanoramaClientService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('PanoramaClient\Mapper\MysqlMapperInterface');
        
        return new PanoramaClientService($mapper);
    }
}