<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace ClientFavorite\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ClientFavorite\Service\FavoriteService;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *         
 */
class FavoriteServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \ClientFavorite\Service\FavoriteService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('ClientFavorite\Mapper\FavoriteMapperInterface');
        
        return new FavoriteService($mapper);
    }
}