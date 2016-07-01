<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace ClientFavorite\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use ClientFavorite\Entity\FavoriteEntity;
use Client\Entity\ClientEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class FavoriteHydrator extends ClassMethods
{

    /**
     *
     * @param string $underscoreSeparatedKeys            
     */
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::hydrate()
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof FavoriteEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $clientEntity = parent::hydrate($data, new ClientEntity());
        
        $object->setClientEntity($clientEntity);
        
        return $object;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::extract()
     */
    public function extract($object)
    {
        if (! $object instanceof FavoriteEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['client_entity']);
        
        return $data;
    }
}