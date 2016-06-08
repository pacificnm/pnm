<?php
namespace ClientFavorite\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ClientFavorite\Controller\DeleteController;

class DeleteControllerFactory implements FactoryInterface
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
        
        return new DeleteController($favoriteService);
    }
}