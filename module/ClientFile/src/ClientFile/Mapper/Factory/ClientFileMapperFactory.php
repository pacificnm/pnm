<?php
namespace ClientFile\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use ClientFile\Mapper\ClientFileMapper;
use ClientFile\Hydrator\ClientFileHydrator;
use ClientFile\Entity\ClientFileEntity;

class ClientFileMapperFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \ClientFile\Mapper\ClientFileMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new ClientFileHydrator());
        
        $prototype = new ClientFileEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new ClientFileMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}