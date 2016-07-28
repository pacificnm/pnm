<?php
namespace Application\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Mapper\GitHubMapper;
use Application\Entity\GitHubEntity;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Application\Hydrator\GitHubHydrator;

class GitHubMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Application\Mapper\GitHubMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new GitHubHydrator());
        
        $prototype = new GitHubEntity();
        
        return new GitHubMapper($hydrator, $prototype);
    }
}

