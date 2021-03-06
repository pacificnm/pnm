<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace ClientFavorite\Service;

use ClientFavorite\Entity\FavoriteEntity;
use ClientFavorite\Mapper\FavoriteMapperInterface;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class FavoriteService implements FavoriteServiceInterface
{

    /**
     *
     * @var FavoriteMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param FavoriteMapperInterface $mapper            
     */
    public function __construct(FavoriteMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFavorite\Service\FavoriteServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFavorite\Service\FavoriteServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFavorite\Service\FavoriteServiceInterface::save()
     */
    public function save(FavoriteEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFavorite\Service\FavoriteServiceInterface::delete()
     */
    public function delete(FavoriteEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \ClientFavorite\Service\FavoriteServiceInterface::hasFavorite()
     */
    public function hasFavorite($clientId, $authId)
    {
        return $this->mapper->hasFavorite($clientId, $authId);
    }
   
}