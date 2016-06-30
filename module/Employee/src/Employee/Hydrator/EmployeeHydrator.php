<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Employee\Entity\EmployeeEntity;
use Auth\Entity\AuthEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class EmployeeHydrator extends ClassMethods
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
        if (! $object instanceof EmployeeEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $authEntity = parent::hydrate($data, new AuthEntity());
        
        $object->setAuthEntity($authEntity);
        
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
        if (! $object instanceof EmployeeEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['auth_entity']);
        
        return $data;
    }
}