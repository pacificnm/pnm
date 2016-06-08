<?php
namespace ClientFavorite\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use ClientFavorite\Mapper\FavoriteMapper;
use ClientFavorite\Hydrator\FavoriteHydrator;
use ClientFavorite\Entity\FavoriteEntity;

class FavoriteMapperFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new FavoriteHydrator());
        
        $prototype = new FavoriteEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new FavoriteMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}