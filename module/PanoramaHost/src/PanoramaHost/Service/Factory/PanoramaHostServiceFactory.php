<?php
namespace PanoramaHost\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PanoramaHost\Service\PanoramaHostService;

class PanoramaHostServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PanoramaHost\Service\PanoramaHostService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('PanoramaHost\Mapper\MysqlMapperInterface');
        
        return new PanoramaHostService($mapper);
    }
}