<?php
namespace WorkorderCredit\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use WorkorderCredit\Entity\CreditEntity;
use PaymentOption\Entity\OptionEntity;
use Account\Entity\AccountEntity;
use AccountLedger\Entity\LedgerEntity;

class CreditHydrator extends ClassMethods
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
        if (! $object instanceof CreditEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $optionEntity = parent::hydrate($data, new OptionEntity());
        
        $object->setOptionEntity($optionEntity);
        
        $accountEntity = parent::hydrate($data, new AccountEntity());
        
        $object->setAccountEntity($accountEntity);
        
        $ledgerEntity = parent::hydrate($data, new LedgerEntity());
        
        $object->setLedgerEntity($ledgerEntity);
        
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
        if (! $object instanceof CreditEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['option_entity']);
        unset($data['account_entity']);
        unset($data['ledger_entity']);
        
        return $data;
    }
}
