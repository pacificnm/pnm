<?php
namespace ClientFavorite\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ClientFavorite\Service\FavoriteService;

class FavoriteServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('ClientFavorite\Mapper\FavoriteMapperInterface');
        
        return new FavoriteService($mapper);
    }
}