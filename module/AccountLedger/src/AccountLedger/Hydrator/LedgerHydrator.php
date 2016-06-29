<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace AccountLedger\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use AccountLedger\Entity\LedgerEntity;
use Account\Entity\AccountEntity;

/**
 *
 * @author jaimie
 *        
 */
class LedgerHydrator extends ClassMethods
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
        if (! $object instanceof LedgerEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $accountEntity = parent::hydrate($data, new AccountEntity());
        
        $object->setAccountEntity($accountEntity);
        
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
        if (! $object instanceof LedgerEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['account_entity']);
        
        return $data;
    }
}