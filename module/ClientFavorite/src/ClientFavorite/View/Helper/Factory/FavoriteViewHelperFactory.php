<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace ClientFavorite\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ClientFavorite\View\Helper\Favorite;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *         
 */
class FavoriteViewHelperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \ClientFavorite\View\Helper\Favorite
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $favoriteService = $realServiceLocator->get('ClientFavorite\Service\FavoriteServiceInterface');
        
        return new Favorite($favoriteService);
    }
}