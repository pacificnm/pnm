<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace ClientFavorite\Mapper;

use ClientFavorite\Entity\FavoriteEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
interface FavoriteMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return FavoriteEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return FavoriteEntity
     */
    public function get($id);

    /**
     *
     * @param FavoriteEntity $entity            
     * @return FavoriteEntity
     */
    public function save(FavoriteEntity $entity);

    /**
     *
     * @param FavoriteEntity $entity            
     * @return boolean
     */
    public function delete(FavoriteEntity $entity);
    
    /**
     * 
     * @param number $clientId
     * @param number $authId
     * @return boolean
     */
    public function hasFavorite($clientId, $authId);
}