<?php
namespace ClientFavorite\Mapper;

use ClientFavorite\Entity\FavoriteEntity;

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
}