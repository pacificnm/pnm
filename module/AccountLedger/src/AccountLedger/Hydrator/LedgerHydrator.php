<?php
namespace AccountLedger\Hydrator;
use Zend\Stdlib\Hydrator\ClassMethods;
use AccountLedger\Entity\LedgerEntity;
use Account\Entity\AccountEntity;

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