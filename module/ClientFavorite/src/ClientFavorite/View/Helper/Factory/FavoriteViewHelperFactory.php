<?php
namespace ClientFavorite\View\Helper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ClientFavorite\View\Helper\Favorite;

class FavoriteViewHelperFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $favoriteService = $realServiceLocator->get('ClientFavorite\Service\FavoriteServiceInterface');
        
        return new Favorite($favoriteService);
    }
}